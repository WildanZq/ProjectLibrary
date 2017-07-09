<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('m_admin');
	}

	public function index()
	{
		$data = [
			'list_event'	=> $this->m_admin->GetAllData('event')
		];
		$this->load->view('index_view', $data);
	}
}
