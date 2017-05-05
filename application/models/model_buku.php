<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class model_buku extends CI_Model{

  public function __construct()
  {
    parent::__construct();
    //Codeigniter : Write Less Do More
  }

  public function getBukuSimple(){
    $kategori = $this->input->post('kategori');
    $judul = $this->input->post('judul');

    $kelasBuku = $this -> getKelasBuku($kategori);

    if($kelasBuku == '-1'){
      echo($this -> error -> returnError("WRONG_CATEGORY",'Kategori yang dipilih tidak valid!'));
      return;
    }

        $mainData = Array();

        // If you think database is fun, think again.

        $query = sprintf('SELECT * FROM `buku` WHERE judul LIKE "%%%1$s%%" AND register REGEXP "^%2$s.+$" OR judul LIKE "%%%1$s%%" AND register REGEXP "^REF\ %2$s.+$"',$judul,$kelasBuku);
        $result = $this->db->query($query);

        foreach($result -> result() as $row){
          $data = Array(
            'judul' => $row -> judul,
            'register' => $row -> register,
            'jumlah' => $row -> jumlah
          );
          array_push($mainData,$data);
        }

        echo json_encode($mainData);
  }

  public function getBukuByRegister(){
      $register = $this->input->get_post('register');

      $query = $this -> db -> get_where('buku', Array(
          'register' => $register
      ));

      if($result -> num_rows() < 0){
        echo "{}";
        return;
      }

      echo json_encode($query -> result()[0]);
  }

  public function getBukuByBarcode(){

    $barcode = $this->input->get_post('barcode');

    $query = sprintf('SELECT buku.* FROM `buku` NATURAL JOIN barcode WHERE barcode = "%s"',$barcode);
    
    $result = $this->db->query($query);

    if($result -> num_rows() < 0){
      echo "{}";
      return;
    }

    echo json_encode($result -> result()[0]);
  }

  public function getKelasBuku($kategori){
    $prefixKategori = "";

    switch ($kategori){
      case "ilmu":
        $prefixKategori = '0';
        break;
      case "filsafat":
        $prefixKategori = '1';
        break;
      case "agama":
        $prefixKategori = '2';
        break;
      case "ips":
        $prefixKategori = '3';
        break;
      case "bahasa":
        $prefixKategori = '4';
        break;
      case "sains":
        $prefixKategori = '5';
        break;
      case "teknologi":
        $prefixKategori = '6';
        break;
      case "kesenian":
        $prefixKategori = '7';
        break;
      case "sastra":
        $prefixKategori = '8';
        break;
      case "sejarah":
        $prefixKategori = '9';
        break;
      default:
        $prefixKategori = '-1';
        break;
    }

    return $prefixKategori;
  }

}
