<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		helper_auth();
		$this->load->model('AuthModel');
		$this->load->model('ConfigsModel');
	}

	public function sessionData()
	{
		$session_id 		= $this->session->userdata('id_app');
		$function 			= 'dashboard';
		$data = [
			'function' 		=> $function,
			'controller' 	=> url_title($function, 'dash', TRUE),
			'profil' 		=> $this->AuthModel->profil($session_id),
			'admin_menu'	=> $this->AuthModel->adminAccess($session_id),
			'configs'		=> $this->ConfigsModel->index()
		];
		return $data;
	}

	// ##################################################
	// ##################################################
	// ##################################################


	public function index()
	{
		// data view
		$this->session->unset_userdata('keyword');
		$data 			= $this->sessionData();
		$data['title'] 	= '';
		// 
		// view
		$this->load->view('administrator/template/header', $data);
		$this->load->view('administrator/dashboard', $data);
		$this->load->view('administrator/template/footer', $data);
	}
}
