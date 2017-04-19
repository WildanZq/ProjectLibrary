<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class admin extends CI_Controller{

  public function __construct()
  {
    parent::__construct();
  }

  function index()
  {
    $this->load->view('login_view');
  }

  function peminjaman() {
    $this->load->view('admin_view');
  }

  function point() {
    $this->load->view('admin_point_view');
  }

}
