<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profil extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		helper_auth();
		$this->load->model('AuthModel');
		$this->load->model('ConfigsModel');
		$this->load->model('ProfilModel');
	}
	public function sessionData()
	{
		$session_id 		= $this->session->userdata('id_app');
		$function 			= 'profil';
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
		$data 			= $this->sessionData();
		$data['title'] 	= '';
		// 
		// view
		$this->load->view('administrator/template/header', $data);
		$this->load->view('administrator/profil/index', $data);
		$this->load->view('administrator/template/footer', $data);
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function update()
	{
		// data view
		$data 			= $this->sessionData();
		$data['title'] 	= 'update';
		// 
		// input
		$password 	= htmlspecialchars($this->input->post('password', true));
		$email 		= htmlspecialchars($this->input->post('email', true));
		$name 		= htmlspecialchars($this->input->post('name', true));
		$date 		= date("Y-m-d H:i:s");
		$folder 	= './assets/images/admin/';
		$thumbnail 	= 'thumbnail/';
		// 
		// details
		$controller 		= $data['controller'];
		$function 			= $data['function'];
		$details 			= $data['profil'];
		$detail_id 			= $details['id'];
		$detail_password 	= $details['password'];
		$detail_email 		= $details['email'];
		$detail_name 		= $details['name'];
		$detail_image 		= $details['image'];
		// 
		// form validation
		if ($detail_email == $email) :
			$unique_email = '';
		else :
			$unique_email = '|is_unique[tbl_admin.email]';
		endif;
		// 
		$valid = [
			array(
				'field' => 'email',
				'rules' => 'required|trim' . $unique_email
			),
			array(
				'field' => 'name',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'password',
				'rules' => 'required|trim'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/profil/update', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			$flash = $detail_name;
			if (password_verify($password, $detail_password)) :
				// 
				// correct password
				if (isset($_FILES['image']['name'])) :
					$config['upload_path'] 		= $folder;
					$config['allowed_types'] 	= 'jpg|jpeg|png';
					$config['max_size'] 		= 1024;
					$config['file_name'] 		= 'admin-' . uniqid();
					$this->load->library('upload', $config);
					// 
					if (!$this->upload->do_upload('image')) :
						$image = $detail_image;
					else :
						if ($detail_image !== 'default.svg') :
							unlink($folder . $detail_image);
							unlink($folder . $thumbnail . $detail_image);
						endif;
						$data_upload = $this->upload->data();
						$config['image_library'] 	= 'gd2';
						$config['source_image'] 	= $folder . $data_upload['file_name'];
						$config['create_thumb'] 	= FALSE;
						$config['width'] 			= 200;
						$config['height'] 			= 200;
						$config['maintain_ratio'] 	= FALSE;
						$config['new_image'] 		= $folder . $thumbnail . $data_upload['file_name'];
						$this->load->library('image_lib', $config);
						$this->image_lib->resize();
						$image 						= $data_upload['file_name'];
					endif;
					$data = [
						'email' 		=> $email,
						'name' 			=> $name,
						'image' 		=> $image,
						'updated_at' 	=> $date
					];
					$this->ProfilModel->update($detail_id, $data);
				endif;
				// 
				$this->session->set_flashdata('alert', 'primary');
				$this->session->set_flashdata('icon', 'fa-check');
				$this->session->set_flashdata('flash', $function . ' hasbeen change');
				redirect($controller);
			else :
				// 
				// incorrect password
				$this->session->set_flashdata('alert', 'warning');
				$this->session->set_flashdata('icon', 'fa-times');
				$this->session->set_flashdata('flash', 'incorrect password');
				redirect($controller . '/update');
			endif;
		endif;
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function password()
	{
		// data view
		$data 			= $this->sessionData();
		$data['title'] 	= 'update password';
		// 
		// input
		$old_password 	= htmlspecialchars($this->input->post('old_password', true));
		$password 		= htmlspecialchars(password_hash($this->input->post('password', true), PASSWORD_DEFAULT));
		$date 			= date("Y-m-d H:i:s");
		// 
		// details
		$controller 		= $data['controller'];
		$details 			= $data['profil'];
		$detail_id 			= $details['id'];
		$detail_password 	= $details['password'];
		// 
		// falidasi form
		$valid = [
			array(
				'field' => 'password',
				'rules' => 'required|trim|min_length[6]'
			),
			array(
				'field' => 'confirm',
				'rules' => 'required|trim|matches[password]'
			),
			array(
				'field' => 'old_password',
				'rules' => 'required|trim'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/profil/password', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			if (password_verify($old_password, $detail_password)) :
				// 
				// correct password
				$data = [
					'password' 		=> $password,
					'updated_at' 	=> $date
				];
				$this->ProfilModel->update($detail_id, $data);
				// 
				// flashdata
				$this->session->set_flashdata('alert', 'primary');
				$this->session->set_flashdata('icon', 'fa-check');
				$this->session->set_flashdata('flash', 'password hasbeen change');
				redirect($controller);
			else :
				// 
				// incorrect password
				// flashdata
				$this->session->set_flashdata('alert', 'warning');
				$this->session->set_flashdata('icon', 'fa-times');
				$this->session->set_flashdata('flash', 'incorrect password');
				redirect($controller . '/password');
			endif;
		endif;
	}
}
