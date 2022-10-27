<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('AuthModel');
		$this->load->model('ConfigsModel');
	}

	public function sessionData()
	{
		$session_id 		= $this->session->userdata('id_app');
		$function 			= 'login';
		$data = [
			'function' 		=> $function,
			'controller' 	=> url_title($function, 'dash', TRUE),
			'profil' 		=> $this->AuthModel->profil($session_id),
			'admin_menu'	=> $this->AuthModel->adminAccess($session_id),
			'configs'		=> $this->ConfigsModel->index()
		];
		return $data;
	}

	public function index()
	{

		$session = $this->session->userdata('id_app');
		if ($session) :
			redirect('dashboard');
		endif;
		// 

		$data 			= $this->sessionData();
		$data['title'] 	= '';
		// 
		// input
		$email = htmlspecialchars($this->input->post('email', true), ENT_QUOTES);
		$password = htmlspecialchars($this->input->post('password', true), ENT_QUOTES);
		// 
		// details
		$admin = $this->AuthModel->login($email);
		// 
		// form validation
		$valid = [
			array(
				'field' => 'email',
				'rules' => 'required|trim',
				'errors' => [
					'required' => '{field} harus di isi !',
				]
			),
			array(
				'field' => 'password',
				'rules' => 'required|trim',
				'errors' => [
					'required' => '{field} harus di isi !',
				]
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/auth', $data);
		else :
			// dissable email
			if (empty($admin)) :
				$this->session->set_flashdata('flash', 'email <b>' . $email . '</b> not registered.');
				redirect('auth');
			// enable email
			else :
				// correct password
				if (password_verify($password, $admin['password'])) :
					if ($admin['status'] == 1) :
						$data = [
							'id_app' => $admin['id']
						];
						$this->session->set_userdata($data);
						redirect('dashboard');
					else :
						$this->session->set_flashdata('flash', 'Sorry you account <b>not active</b>, please contac admin.');
						redirect('auth');
					endif;
				// incorrect password
				else :
					$this->session->set_flashdata('flash', 'Wrong password.');
					redirect('auth');
				endif;
			endif;
		endif;
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function logout()
	{
		$this->session->unset_userdata('id_app');
		$this->session->unset_userdata('keyword');
		$this->session->set_flashdata('flash', 'You havebeen logout.');
		redirect('auth');
	}
}
