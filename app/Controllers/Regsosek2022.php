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
    }

    public function index()
    {
        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/index');
    }

    public function absensi($status = null)
    {
        if ($status == null) {
            $data['datang'] = $this->absensi->where('email', $this->email)->where('status', 'datang')
                ->where('tanggal', date('Y-m-d'))->get()->getRowArray();
            $data['pulang'] = $this->absensi->where('email', $this->email)->where('status', 'pulang')
                ->where('tanggal', date('Y-m-d'))->get()->getRowArray();

            return view('templates/header')
                . view('templates/sidebar', $this->user)
                . view('templates/topbar')
                . view('regsosek2022/absensi', $data);
        } else {
            $cek = $this->absensi->where('email', $this->email)->where('status', $status)->orderBy('id', 'DESC')->get()->getRowArray();
            if ($cek != null) {
                if ($status == 'datang') {
                    if ($cek['tanggal'] != date('Y-m-d')) {
                        $this->absensi->insert([
                            'email' => $this->email,
                            'tanggal' => date('Y-m-d'),
                            'jam' => date("H:i:s"),
                            'status' => 'datang'
                        ]);
                    }
                } else if ($status == 'pulang') {
                    if ($cek['tanggal'] != date('Y-m-d')) {
                        $this->absensi->insert([
                            'email' => $this->email,
                            'tanggal' => date('Y-m-d'),
                            'jam' => date("H:i:s"),
                            'status' => 'pulang'
                        ]);
                    }
                }
            } else {
                $this->absensi->insert([
                    'email' => $this->email,
                    'tanggal' => date('Y-m-d'),
                    'jam' => date("H:i:s"),
                    'status' => $status
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

        // dd($data['arusdokumen']);
        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('regsosek2022/arusdokumen', $data);
    }

    public function arusdokumenedit($kodewilayah)
    {
        if ($this->request->getPost() == null) {
            $data['arusdokumen'] = $this->sls->select('sls.*, arusdk.diterima_ipds, arusdk.diterima_mitra, arusdk.mitra, arusdk.kembali_tu, arusdk.ket')
                ->join('regsosek2022_arusdokumen as arusdk', 'sls.k_wil = arusdk.k_wil', 'left')
                ->where('sls.k_wil', $kodewilayah)
                ->get()->getRowArray();

            $data['mitras'] = $this->userinfo->select('email, nama')
                ->where('regsosek2022', 1)->get()->getResultArray();

            return view('templates/header')
                . view('templates/sidebar', $this->user)
                . view('templates/topbar')
                . view('regsosek2022/arusdokumenedit', $data);
        } else {
            if ($this->arusdokumen->where('k_wil', $kodewilayah)->get()->getResult() == null) {
                $this->arusdokumen->insert([
                    'k_wil' => $kodewilayah,
                    'ket' => strtoupper($this->request->getPost('ket')),
                    'diterima_ipds' => $this->request->getPost('diterima_ipds'),
                    'diterima_mitra' => $this->request->getPost('diterima_mitra'),
                    'mitra' => strtoupper($this->request->getPost('mitra')),
                    'kembali_tu' => $this->request->getPost('kembali_tu'),
                ]);
            } else {
                $this->arusdokumen->set([
                    'ket' => strtoupper($this->request->getPost('ket')),
                    'diterima_mitra' => $this->request->getPost('diterima_mitra'),
                    'mitra' => strtoupper($this->request->getPost('mitra')),
                    'kembali_tu' => $this->request->getPost('kembali_tu'),
                ])->where('k_wil', $kodewilayah)->update();
            }

            return redirect()->to(base_url('/regsosek2022/arusdokumen'));
        }
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
