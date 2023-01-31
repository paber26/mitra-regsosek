<?php

namespace App\Controllers;

// require 'vendor/autoload.php';

use App\Controllers\BaseController;


class Profil extends BaseController
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
        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('profil/index');
    }

    public function edit()
    {
        if (isset($_FILES["file"]["name"]) || $this->request->getPost() != null) {
            $datagambar = addslashes(file_get_contents($_FILES['file']['tmp_name']));
            $propertiesgambar = getimageSize($_FILES['file']['tmp_name']);


            // dd(base_url('images/') . '/' . basename($_FILES["file"]["tmp_name"]));
            $targetFile = base_url('images') . '/' . basename($_FILES["file"]["tmp_name"]);

            if (move_uploaded_file($_FILES["file"]["tmp_name"], $targetFile)) {
                //file was successfully uploaded
                dd('yes');
                dd(basename($_FILES["file"]["tmp_name"]));
            }
            dd('no');

            dd('no');

            $this->userinfo->set([
                'rekening' => $this->request->getPost('rekening'),
                'nomor_rekening' => $this->request->getPost('nomor_rekening'),
                'tipe_gambar' => $propertiesgambar['mime'],
                'gambar_rekening' => $datagambar
            ])->where('email', $this->user['email'])->update();

            return redirect()->to(base_url('/profil'));
        }

        return view('templates/header')
            . view('templates/sidebar', $this->user)
            . view('templates/topbar')
            . view('profil/edit');
    }
}
