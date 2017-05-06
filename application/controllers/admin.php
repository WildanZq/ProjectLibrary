<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_admin');
  }

  function index()
  {
    $this->load->view('login_view');
  }

  function peminjaman() {
      $data = [
          'terlambat'       => $this->m_admin->GetDataSetting()->terlambat
      ];
    $this->load->view('admin_view', $data);
  }

  function getPeminjam() {
      if ($this->input->post('data')) {
          $data = $this->input->post('data');
          $kategori = $data[0];
          $value = $data[1];
          $where = 1;

          switch ($kategori) {
              case 'Barcode':
                  $where = "barcode.barcode LIKE '$value%'";
                  break;
              case 'Nama':
                  $where = "nama_lengkap LIKE '$value%'";
                  break;
              case 'Kelas':
                  $kelas = rtrim(substr($value, 0, 3), " ");
                  $jurusan = rtrim(substr($value, 3, 3), " ");
                  $nkelas = rtrim(substr($value, 6), " ");
                  $angkatan = "";
                  if ($kelas == "X" || $kelas == "x") $angkatan = date('Y') - 1992;
                  else if ($kelas == "XI" || $kelas == "xi") $angkatan = (date('Y') - 1992) - 1;
                  else if ($kelas == "XII" || $kelas == "xii") $angkatan = (date('Y') - 1992) - 2;
                  $where = "angkatan LIKE '$angkatan%' AND jurusan LIKE '$jurusan%' AND nomor_kelas LIKE '$nkelas%'";
                break;
              case 'Judul':
                  $where = "judul LIKE '$value%'";
                  break;
              default:
                  $where = 1;
                  break;
          }
          $result = $this->m_admin->GetPeminjaman($where);
          echo json_encode($result);
      } else {
          redirect('404');
      }
  }

  function addPeminjaman() {
      if ($this->input->post('submit')) {
          # code...
      } else {
          # code...
      }
  }

  function point() {
    $this->load->view('admin_point_view');
  }

  function event() {
    $this->load->view('admin_event_view');
  }

  function laporan() {
    $this->load->view('admin_laporan_view');
  }

}
