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
    if ($this->session->userdata(md5('logged_in'))) {
        if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
            redirect('admin/peminjaman');
        } else {
            redirect('_404');
        }
    } else {
        if ($this->input->post('submit')) {
            $this->form_validation->set_rules('username', 'Username', 'trim|required');
            $this->form_validation->set_rules('password', 'Password', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                if ($this->m_admin->setLoggedAdmin()) {
                    redirect('admin');
                } else {
                    $data['notif'] = 'Login Gagal!';
                    $this->load->view('login_view', $data);
                }
            } else {
                $data['notif'] = validation_errors();
                $this->load->view('login_view', $data);
            }
        } else {
            $this->load->view('login_view');
        }
    }
  }

  function peminjaman() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
              $data = [
                  'denda' => $this->m_admin->GetDataSetting()
              ];
              $this->load->view('admin_view', $data);
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function getPeminjam() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
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
                  redirect('_404');
              }
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function getStatusPeminjam() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
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
                  redirect('_404');
              }
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function addPeminjaman() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
              if ($this->input->post('submit')) {
                  $db = $this->m_admin->AddPeminjaman();
                  if ($db === true) {
                      redirect('Admin/peminjaman');
                  } else {
                      echo "gak iso";
                  }
              } else {
                  redirect('_404');
              }
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function getDataPeminjam() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
              if ($this->input->post('data')) {
                  $data = $this->input->post('data');
                  $db = $this->m_admin->GetPeminjaman("peminjaman.id_peminjaman = '$data'");
                  echo json_encode($db);
              } else {
                  redirect('_404');
              }
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function kembalikan() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
              if ($this->input->post('data')) {
                  $data = $this->input->post('data');
                  $db = $this->m_admin->SetKembali($data);
                  echo $db;
              } else {
                  redirect('_404');
              }
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function hilang() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
              if ($this->input->post('data')) {
                  $data = $this->input->post('data');
                  $db = $this->m_admin->SetHilang($data);
                  echo $db;
              } else {
                  redirect('_404');
              }
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function changeSetting() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
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
                  redirect('_404');
              }
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function point() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
              $this->load->view('admin_point_view');
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function buku() {
    $this->load->view('admin_buku_view');
  }

  function event() {
    if ($this->session->userdata(md5('logged_in'))) {
        if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
            if ($this->input->post('submit')) {
                // $this->form_validation->set_rules('judul', 'Judul', 'trim|required');
                // $this->form_validation->set_rules('konten', 'Konten', 'trim|required|min_length[10]');
                $tgl_mulai = $this->input->post('tgl_mulai');
                $tgl_akhir = $this->input->post('tgl_akhir');
                if ($tgl_mulai <= $tgl_akhir) {
                    $config['upload_path'] = './assets/images/event/';
                    $config['allowed_types'] = 'jpeg|jpg|png';
                    $config['max_size']  = '1024';
                    $this->load->library('upload', $config);
                    if ($this->upload->do_upload('image')){
                        if ($this->m_admin->addEvent($this->upload->data())) {
                            $data['notif'] = 'Event berhasil ditambahkan';
                            $this->load->view('admin_event_view', $data);
                        } else {
                            $data['notif'] = 'Event gagal ditambahkan';
                            $this->load->view('admin_event_view', $data);
                        }
                    }
                    else{
                        $data['notif'] = $this->upload->display_errors();
                        $this->load->view('admin_event_view', $data);
                    }
                } else {
                    $data['notif'] = 'Tanggal tidak sesuai';
                    $this->load->view('admin_event_view', $data);
                }
            } else {
                $this->load->view('admin_event_view');
            }
        } else {
            redirect('_404');
        }
    } else {
        redirect('_404');
    }
  }

  public function getEvent() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
              if ($this->input->post('data')) {
                  $data = $this->input->post('data');
                  $date = $data[0];
                  $value = $data[1];
                  $where = "";
                  if ($value != "") {
                      $where .= "judul_event LIKE '$value%' AND ";
                  }
                  if ($date != "") {
                      $where .= "'$date' <= tgl_akhir AND '$date' >= tgl_mulai AND ";
                  }
                  if ($value == "" && $date == "") {
                      $where = 1;
                  }
                  if ($where != 1) {
                      $where = rtrim($where, "AND ");
                  }
                  $result = $this->m_admin->getEvent($where);
                  echo json_encode($result);
              } else {
                  redirect('_404');
              }
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  public function Delete() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
              if (!empty($this->uri->segment(3))) {
                  if ($this->uri->segment(3) == 'event') {
                      if ($this->input->post('data')) {
                          $id = $this->input->post('data');
                          if ($this->m_admin->DeleteEvent($id)) {
                              echo "true";
                          } else {
                              echo "false";
                          }
                      } else {
                          redirect('_404');
                      }
                  } else {
                      redirect('_404');
                  }
              } else {
                  redirect('_404');
              }
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  function siswa() {
    $this->load->view('admin_siswa_view');
  }

  function organisasi() {
    $this->load->view('admin_organisasi_view');
  }

  function laporan() {
      if ($this->session->userdata(md5('logged_in'))) {
          if ($this->session->userdata(md5('logged_role')) == 'pengurus') {
              $data = [
                  'all'     => $this->m_admin->GetLaporan('all'),
                  'denda'     => $this->m_admin->GetLaporan('denda'),
                  'peminjaman'     => $this->m_admin->GetLaporan('peminjaman'),
                  'pengembalian'     => $this->m_admin->GetLaporan('pengembalian')
              ];
              $this->load->view('admin_laporan_view', $data);
          } else {
              redirect('_404');
          }
      } else {
          redirect('_404');
      }
  }

  public function asd()
  {
      var_dump($this->m_admin->GetLaporan('pengembalian'));
  }

  public function logout() {
      $this->session->unset_userdata(md5('logged_in'));
      $this->session->unset_userdata(md5('logged_role'));
      $this->session->unset_userdata(md5('logged_admin_id'));
      redirect('Admin');
  }

}
