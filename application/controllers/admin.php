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
          'denda' => $this->m_admin->GetDataSetting()
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
          $where .= " AND peminjaman.kembali = 0";
          $result = $this->m_admin->GetPeminjaman($where);
          echo json_encode($result);
      } else {
          redirect('404');
      }
  }

  function getStatusPeminjam() {
      if ($this->input->post('tgl')) {
          $date = $this->input->post('tgl');
          $kembali = strtotime($date);
          $now = strtotime(date('Y-m-d'));
          $work_days = 0;
          $result = [];
          if ($kembali <= $now) {
              while ($kembali <= $now) {
                  $week = date('N', $kembali);
                  if ($week < 5) {
                      $work_days++;
                  }
                  $kembali += 86400; // tambah 1 hari
              }
              $denda = $this->m_admin->GetDataSetting()->terlambat;
            //   $result = 'red|'.$work_days*$denda;
              $result = [ "status" => "red", "sisa" => $work_days*$denda ];
          } else {
              $sisa = floor(($kembali - $now) / (60 * 60 * 24));
              $result = [ "status" => "green", "sisa" => $sisa ];
          }
          echo json_encode($result);
      } else {
          redirect('404');
      }
  }

  function addPeminjaman() {
      if ($this->input->post('submit')) {
          $db = $this->m_admin->AddPeminjaman();
          if ($db === true) {
              redirect('Admin/peminjaman');
          } else {
              echo " gak iso";
          }
      } else {
          redirect('404');
      }
  }

  function getDataPeminjam() {
      if ($this->input->post('data')) {
          $data = $this->input->post('data');
          $db = $this->m_admin->GetPeminjaman("peminjaman.id_peminjaman = '$data'");
          echo json_encode($db);
      } else {
          redirect('404');
      }
  }

  function kembalikan() {
      if ($this->input->post('data')) {
          $data = $this->input->post('data');
          $db = $this->m_admin->SetKembali($data);
          echo $db;
      } else {
          redirect('404');
      }
  }

  function hilang() {
      if ($this->input->post('data')) {
          $data = $this->input->post('data');
          $db = $this->m_admin->SetHilang($data);
          echo $db;
      } else {
          redirect('404');
      }
  }

  function changeSetting() {
      if ($this->input->post('saveSetting')) {
          $terlambat = $this->input->post('terlambat');
          $hilang = $this->input->post('hilang');
          $print = $this->input->post('print');
          $reward = $this->input->post('reward');
          $bool = false;
          if (!empty($terlambat)) {
              if ($this->m_admin->ChangeSetting(['terlambat' => $terlambat]) == true) $bool = true;
              else $bool = false;
          }
          if (!empty($hilang)) {
              if ($this->m_admin->ChangeSetting(['hilang' => $hilang]) == true) $bool = true;
              else $bool = false;
          }
          if (!empty($print)) {
              if ($this->m_admin->ChangeSetting(['print' => $print]) == true) $bool = true;
              else $bool = false;
          }
          if (!empty($reward)) {
              if ($this->m_admin->ChangeSetting(['reward' => $reward]) == true) $bool = true;
              else $bool = false;
          }
          if ($bool == true)
              redirect($this->input->post('from'));
          else
              echo "gagal";
      } else {
          redirect('404');
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
