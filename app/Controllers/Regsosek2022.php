<?php

namespace App\Controllers;

// require 'vendor/autoload.php';

use App\Controllers\BaseController;
use DateTime;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;


class Regsosek2022 extends BaseController
{
    protected $email;
    protected $user;

    protected $db;
    protected $users;
    protected $userinfo;
    protected $sls;
    protected $arusdokumen;
    protected $dokumenerror;
    protected $absensi;
    protected $entrian;


    public function __construct()
    {
        $this->db = db_connect();
        $this->userinfo = $this->db->table('userinfo');

        $this->email = service('authentication')->user()->email;
        $this->user = $this->userinfo->where('email', $this->email)->get()->getRowArray();

        $this->users = $this->db->table('users');
        $this->sls = $this->db->table('sls');
        $this->arusdokumen = $this->db->table('regsosek2022_arusdokumen as ad');
        $this->dokumenerror = $this->db->table('regsosek2022_dokumenerror as de');
        $this->absensi = $this->db->table('regsosek2022_absensi as ab');
        $this->entrian = $this->db->table('regsosek2022_entrian as e');
    }

    public function index()
    {
        $kec = $this->sls->select('k_kec, n_kec')->distinct('k_kec')->get()->getResultArray();

        $data['diterima_ipds'] = 0;
        $data['diterima_mitra'] = 0;
        $data['kembali_tu'] = 0;

        $data['progress'] = [];
        foreach ($kec as $k) {
            $total = $this->sls->where('k_kec', $k['k_kec'])->countAllResults();
            $tmp = $this->arusdokumen->like('k_wil', '1206' . $k['k_kec'])->get()->getResultArray();

            $diterima_ipds = 0;
            $diterima_mitra = 0;
            $kembali_tu = 0;
            foreach ($tmp as $t) {
                if ($t['diterima_ipds'] != '0000-00-00') {
                    $diterima_ipds++;
                }
                if ($t['diterima_mitra'] != '0000-00-00') {
                    $diterima_mitra++;
                }
                if ($t['kembali_tu'] != '0000-00-00') {
                    $kembali_tu++;
                }
            }

            $data['diterima_ipds'] += $diterima_ipds;
            $data['diterima_mitra'] += $diterima_mitra;
            $data['kembali_tu'] += $kembali_tu;


            array_push($data['progress'], [
                'k_kec' => $k['k_kec'],
                'n_kec' => $k['n_kec'],
                'total' => $total,
                'diterima_ipds' => $diterima_ipds,
                'persentase' => number_format((float)$diterima_ipds / $total * 100, '2'),
                'diterima_mitra' => $diterima_mitra,
                'kembali_tu' => $kembali_tu,
            ]);
        }

        $data['total_sls'] = $this->sls->countAllResults();
        $data['diterima_ipds_persen'] = number_format((float)$data['diterima_ipds'] / $data['total_sls'] * 100, '2');
        $data['diterima_mitra_persen'] = number_format((float)$data['diterima_mitra'] / $data['total_sls'] * 100, '2');
        $data['kembali_tu_persen'] = number_format((float)$data['kembali_tu'] / $data['total_sls'] * 100, '2');

        $data['entrian'] = $this->entrian->select('e.*, u.nama')
            ->join('userinfo as u', 'e.email = u.email', 'left')
            ->orderBy('e.total')->get()->getResultArray();


        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/index', $data);
    }

    public function absensi($status = null)
    {
        if ($status == null) {
            $data['absensi'] = $this->absensi->where('email', $this->email)->where('tanggal', date('Y-m-d'))->get()->getRowArray();

            $data['kehadiran'] = $this->absensi->select('ab.*, userinfo.nama')
                ->join('userinfo', 'ab.email = userinfo.email', 'left')->get()->getResultArray();

            return view('templates/header')
                . view('templates/sidebar', $this->user)
                . view('templates/topbar')
                . view('regsosek2022/absensi', $data);
        } else {
            $cek = $this->absensi->where('email', $this->email)->where('tanggal', date('Y-m-d'))->get()->getRowArray();
            if (($cek == null) && (date('H:i:s') > '07:30:00') && ($status == 'datang')) {
                $this->absensi->insert([
                    'email' => $this->email,
                    'tanggal' => date('Y-m-d'),
                    'datang' => date("H:i:s"),
                ]);
            } else if (($cek != null) && ($status == 'pulang') && (date('H:i:s') > '15:00:00')) {
                $this->absensi->where('email', $this->email)->where('tanggal', date('Y-m-d'))->update([
                    'pulang' => date("H:i:s"),
                ]);
            }
            return redirect()->to(base_url('/regsosek2022/absensi'));
        }
    }

    public function arusdokumen()
    {
        $data['arusdokumen'] = $this->sls->select('sls.k_wil, arusdk.diterima_ipds, arusdk.diterima_mitra, arusdk.mitra, arusdk.kembali_tu, arusdk.ket')
            ->join('regsosek2022_arusdokumen as arusdk', 'sls.k_wil = arusdk.k_wil', 'left')
            ->get()->getResultArray();

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/arusdokumen', $data);
    }

    public function dokumenerror()
    {
        $spreadsheet = new Spreadsheet();
        // $sheet = $spreadsheet->getActiveSheet();
        // $sheet->setCellValue('A1', 'Hello World !');


        // $writer = new Xlsx($spreadsheet);
        // $writer->save('hello world.xlsx');

        // $spreadsheet = IOFactory::load('write.xls');

        // $worksheet = $spreadsheet->getActiveSheet();

        // for ($i = 1; $i < 3; $i++) {
        //     echo $worksheet->getCell('A' . $i)->getValue();
        // }
        // dd('ok');

        // $worksheet->getCell('A2')->setValue();

        // $writer = IOFactory::createWriter($spreadsheet, 'Xls');
        // $writer->save('write.xls');

        // dd('oke');

        $de = $this->dokumenerror->select('k_wil')->distinct()->get()->getResultArray();

        $data['dokumenerror'] = [];
        foreach ($de as $d) {
            $mitra = $this->arusdokumen->where('k_wil', $d['k_wil'])->get()->getRowArray();
            // dd($mitra);
            array_push($data['dokumenerror'], [
                'k_wil' => $d['k_wil'],
                'mitra' => $mitra == null ? '-' : $mitra['mitra'],
                'total_error' => $this->dokumenerror->where('k_wil', $d['k_wil'])->countAllResults(),
                'diperbaiki' => $this->dokumenerror->where('k_wil', $d['k_wil'])->where('perlakuan !=', null)->countAllResults()
            ]);
        }
        // dd($data['dokumenerror']);

        // $data['dokumenerror'] = $this->arusdokumen->join('regsosek2022_dokumenerror as e', 'ad.k_wil = e.k_wil')
        //     ->get()->getResultArray();

        // $dat = $this->arusdokumen->select('ad.k_wil')->distinct()
        //     ->join('regsosek2022_dokumenerror as e', 'ad.k_wil = e.k_wil')
        //     ->get()->getResultArray();
        // dd($dat);

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/dokumenerror', $data);
    }

    public function dokumenerrorlihat($kodewilayah, $id = null)
    {
        if ($id == null) {
            $data['dokumenerror'] = $this->arusdokumen->where('ad.k_wil', $kodewilayah)
                ->join('regsosek2022_dokumenerror as e', 'ad.k_wil = e.k_wil')
                ->get()->getResultArray();

            // dd($data);

            // $dat = $this->arusdokumen->select('ad.k_wil')->distinct()
            //     ->join('regsosek2022_dokumenerror as e', 'ad.k_wil = e.k_wil')
            //     ->get()->getResultArray();
            // dd($dat);

            return view('templates/header')
                . view('templates/sidebar', $this->user)
                . view('templates/topbar')
                . view('regsosek2022/dokumenerrorlihat', $data);
        } else {
            if ($this->request->getPost() != null) {
                $this->dokumenerror->set([
                    'validasi' => strtoupper($this->request->getPost('validasi')),
                    'perlakuan' => $this->request->getPost('perlakuan'),
                ])->where('id', $id)->update();

                return redirect()->to(base_url('/regsosek2022/dokumenerror/' . $kodewilayah));
            } else {

                $data['arusdokumen'] = $this->sls->select('sls.*, arusdk.mitra, arusdk.ket')
                    ->join('regsosek2022_arusdokumen as arusdk', 'sls.k_wil = arusdk.k_wil', 'left')
                    ->where('sls.k_wil', $kodewilayah)
                    ->get()->getRowArray();

                $data['dokumenerror'] = $this->dokumenerror->where('id', $id)->get()->getRowArray();

                // dd($data);

                return view('templates/header')
                    . view('templates/sidebar', $this->user)
                    . view('templates/topbar')
                    . view('regsosek2022/dokumenerroredit', $data);
            }
        }
    }

    public function petugas()
    {
        $data['petugas'] = $this->userinfo->where('regsosek2022', 1)->get()->getResultArray();
        // dd($data);

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/petugas', $data);
    }

    public function petugastambah()
    {
        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/petugastambah');
    }

    public function daftarsls()
    {
        $data['slss'] = $this->sls->get()->getResultArray();
        // dd($data['slss']);

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/daftarsls', $data);
    }
}
