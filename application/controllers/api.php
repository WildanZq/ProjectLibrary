<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class API extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(Array(
      'model_buku' => 'buku',
      'model_error' => 'error',
      'm_admin'     => 'm_admin'
    ));
  }

  function index()
  {
    echo("API Documentation under progress. Please Wait...");
  }

  //TODO : Fix Escape String like Quotation Mark

  function getBukuSimple(){

    $kategori = $this->input->post('kategori');
    $judul = $this->input->post('judul');

    if($kategori == "" || $judul == ""){
      echo($this -> error -> returnError("EMPTY_FIELD",'Field ada yang belum terisi, mohon cek ulang!'));
      return;
    }

    $this -> buku -> getBukuSimple();

  }

  function getBukuByRegister(){

    $register = $this->input->get_post('register');

    if($register == ""){
      echo($this -> error -> returnError("EMPTY_FIELD",'Field ada yang belum terisi, mohon cek ulang!'));
      return;
    }

    $this -> buku -> getBukuByRegister();
  }

  function getBukuByBarcode(){

    $barcode = $this->input->get_post('barcode');

    if($barcode == ""){
      echo($this -> error -> returnError("EMPTY_FIELD",'Field ada yang belum terisi, mohon cek ulang!'));
      return;
    }

    $this -> buku -> getBukuByBarcode();
  }

  function getSiswa() {
      $where = 1;
      $data = $this->input->post('data');
      $kelas = rtrim(substr($data[0], 0, -3), " ");
      $jurusan = rtrim(substr($data[0], -3), " ");
      $angkatan = "";
      if ($kelas == "x") $angkatan = date('Y') - 1992;
      else if ($kelas == "xi") $angkatan = (date('Y') - 1992) - 1;
      else if ($kelas == "xii") $angkatan = (date('Y') - 1992) - 2;
      $where = "angkatan LIKE '$angkatan%' AND jurusan LIKE '$jurusan%'";
      if ($data[1] != "") {
          $where .= " AND nomor_kelas LIKE '$data[1]%'";
      }
      $siswa = $this->m_admin->GetSpecificSiswa($where);
      echo json_encode($siswa);
  }

}
