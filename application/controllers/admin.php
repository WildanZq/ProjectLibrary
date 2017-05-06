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
          'list_peminjaman' => $this->m_admin->GetPeminjaman(),
          'terlambat'       => $this->m_admin->GetDataSetting()->terlambat
      ];
    $this->load->view('admin_view', $data);
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
