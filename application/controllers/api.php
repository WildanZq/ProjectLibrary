<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class API extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  function index()
  {

  }

  function getBuku(){
    $kategori = $this->input->post('kategori');
    $judul = $this->input->post('judul');

    if($kategori == "" || $judul == ""){
      $error = Array(
        'errorCode' => 1,
        'errorMessage' => "Field ada yang kosong!"
      );
      echo json_encode($error);
      return;
    }
    
    $this->db->like('judul', $judul, 'both');
    $result = $this->db->get('buku');

    $mainData = Array();

    foreach($result -> result() as $row){
      $data = Array(
        'judul' => $row -> judul,
        'jumlah' => $row -> jumlah
      );
      array_push($mainData,$data);

      }

    echo json_encode($mainData);

  }

}
