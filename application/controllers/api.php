<?php
defined('BASEPATH') OR exit('No direct script access allowed');


class API extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
    $this->load->model(Array(
      'model_buku' => 'buku',
      'model_error' => 'error'
    ));
  }

  function index()
  {
    echo("API Documentation under progress. Please Wait...");
  }

  function getBukuFrontPage(){

    $kategori = $this->input->post('kategori');
    $judul = $this->input->post('judul');

    if($kategori == "" || $judul == ""){
      echo($this -> error -> returnError("EMPTY_FIELD",'Field ada yang belum terisi, mohon cek ulang!'));
      return;
    }

    $this -> buku -> getBukuFrontPage();

  }

  function getBukuByRegister(){
    $register = $this->input->get_post('register');

    if($register == ""){
      echo($this -> error -> returnError("EMPTY_FIELD",'Field ada yang belum terisi, mohon cek ulang!'));
      return;
    }
  }
}
