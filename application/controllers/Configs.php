<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Configs extends CI_Controller
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
		$function 			= 'configs';
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
		$data				= $this->sessionData();
		$data['title']		= '';
		$data['data']		= $this->ConfigsModel->index();
		// 
		// input
		$application 	= htmlspecialchars($this->input->post('application', TRUE));
		$copyright 		= htmlspecialchars($this->input->post('copyright', TRUE));
		$powered 		= htmlspecialchars($this->input->post('powered', TRUE));
		$description 	= htmlspecialchars($this->input->post('description', TRUE));
		$map 			= htmlspecialchars($this->input->post('map', TRUE));
		$folder 		= './assets/images/';
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		$details 		= $data['data'];
		$detail_image 	= $details['image'];
		// 
		// form validation
		$valid = [
			array(
				'field' => 'application',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'copyright',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'powered',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'description',
				'rules' => 'required|trim'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/configs', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			// 
			// update
			if (isset($_FILES['image']['name'])) :
				$config['upload_path'] 		= $folder;
				$config['allowed_types'] 	= 'jpg|jpeg|png';
				$config['max_size'] 		= 1024;
				$config['file_name'] 		= 'logo-' . uniqid();
				$this->load->library('upload', $config);
				// 
				// 
				if (!$this->upload->do_upload('image')) :
					$image = $detail_image;
				else :
					if ($detail_image !== 'logo.svg') :
						unlink($folder . $detail_image);
					endif;
					$data_upload = $this->upload->data();
					$config['image_library'] 	= 'gd2';
					$config['source_image'] 	= $folder . $data_upload['file_name'];
					$config['create_thumb'] 	= FALSE;
					$config['width'] 			= 200;
					$config['height'] 			= 200;
					$config['maintain_ratio'] 	= FALSE;
					$config['new_image'] 		= $folder . $data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$image 						= $data_upload['file_name'];
				endif;
				$data = [
					'application' 	=> $application,
					'copyright' 	=> $copyright,
					'powered' 		=> $powered,
					'description' 	=> $description,
					'map' 			=> $map,
					'image' 		=> $image
				];
				$this->ConfigsModel->update($data);
			endif;
			// 
			// flashdata
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('icon', 'fa-check');
			$this->session->set_flashdata('flash', $function . ' hasbeen updated');
			redirect($controller);
		endif;
	}
}
