<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		helper_auth();
		$this->load->model('AuthModel');
		$this->load->model('ConfigsModel');
		$this->load->model('AdminModel');
	}

	public function sessionData()
	{
		$session_id 		= $this->session->userdata('id_app');
		$function 			= 'admin';
		$data = [
			'function' 		=> $function,
			'controller' 	=> url_title($function, 'dash', TRUE),
			'profil' 		=> $this->AuthModel->profil($session_id),
			'admin_menu'	=> $this->AuthModel->adminAccess($session_id),
			'configs'		=> $this->ConfigsModel->index()
		];
		return $data;
	}

	public function searching()
	{
		$search 			= htmlspecialchars($this->input->post('search', true));
		$keyword 			= htmlspecialchars($this->input->post('keyword', true));
		if ($search) :
			$this->session->unset_userdata('keyword');
			$this->session->set_userdata('keyword', $keyword);
		else :
			$keyword = $this->session->userdata('keyword');
		endif;

		$data = [
			'keyword' => $keyword
		];
		return $data;
	}

	public function reset()
	{
		$data			= $this->sessionData();
		$function 		= $data['function'];
		$this->session->unset_userdata('keyword');
		redirect($function);
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
		// details
		$controller 	= $data['controller'];
		$searching		= $this->searching();
		$keyword		= $searching['keyword'];
		// 
		// pagination
		$this->load->library('pagination');
		$config['base_url'] 	= base_url('') . $controller . '/index';
		$config['total_rows'] 	= $this->AdminModel->pagination($keyword);
		$config['per_page'] 	= 10;
		$config['num_links'] 	= 2;
		$this->pagination->initialize($config);
		$data['total_result'] 	= $config['total_rows'];
		$data['start'] 			= $this->uri->segment(3);
		$data['data'] 			= $this->AdminModel->index($config['per_page'], $data['start'], $keyword);
		// 
		// view
		$this->load->view('administrator/template/header', $data);
		$this->load->view('administrator/admin/index', $data);
		$this->load->view('administrator/template/footer', $data);
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function read($id)
	{
		// data view
		$this->searching();
		$data			= $this->sessionData();
		$data['data'] 	= $this->AdminModel->read($id);
		$data['title']	= 'detail';
		// 
		// view
		$this->load->view('administrator/template/header', $data);
		$this->load->view('administrator/admin/read', $data);
		$this->load->view('administrator/template/footer', $data);
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function delete($id)
	{
		// data view
		$data 			= $this->sessionData();
		$data['title'] 	= 'delete';
		$data['data'] 	= $this->AdminModel->read($id);
		// 
		// details
		$function 		= $data['function'];
		$controller 	= $data['controller'];
		$details 		= $data['data'];
		$detail_name 	= $details['name'];
		$detail_image 	= $details['image'];
		$folder 		= './assets/admin/';
		$thumbnail 		= 'thumbnail/';
		$flashData 		= $detail_name;
		// 
		// delete file
		if ($detail_image !== 'default.svg') :
			unlink($folder . $detail_image);
			unlink($folder . $thumbnail . $detail_image);
		endif;
		// 
		// delete
		$this->AdminModel->delete($id);
		// 
		// delete access
		$this->AdminModel->deleteAccess($id);
		// 
		// flashdata
		$this->session->set_flashdata('alert', 'danger');
		$this->session->set_flashdata('icon', 'fa-trash');
		$this->session->set_flashdata('flash', $function . ' <b>' . $flashData . '</b> hasbeen deleted');
		redirect($controller);
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function create()
	{
		// data view
		$this->searching();
		$data			= $this->sessionData();
		$data['title']	= 'create';
		$data['data'] = $this->AdminModel->adminMenu();
		$data['level'] = $this->AdminModel->adminLevel();
		// 
		// input
		$password 	= htmlspecialchars(password_hash($this->input->post('password', true), PASSWORD_DEFAULT));
		$email 		= htmlspecialchars($this->input->post('email', true));
		$name 		= htmlspecialchars($this->input->post('name', true));
		$status 	= htmlspecialchars($this->input->post('status', true));
		$level 		= htmlspecialchars($this->input->post('level', true));
		$access 	= $this->input->post('access', true);
		$date 		= date("Y-m-d H:i:s");
		$folder 	= './assets/admin/';
		$thumbnail 	= 'thumbnail/';
		$flashData 	= $name;
		// 
		// details
		$controller = $data['controller'];
		$function 	= $data['function'];
		// 
		// form validation
		$valid = [
			array(
				'field' => 'email',
				'rules' => 'required|trim|valid_email|is_unique[tbl_admin.email]'
			),
			array(
				'field' => 'password',
				'rules' => 'required|trim|min_length[6]'
			),
			array(
				'field' => 'confirm',
				'rules' => 'required|trim|matches[password]'
			),
			array(
				'field' => 'name',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'access[]',
				'rules' => 'required|trim'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/admin/create', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			// 
			// create
			if (isset($_FILES['image']['name'])) :
				$config['upload_path'] 		= $folder;
				$config['allowed_types'] 	= 'jpg|jpeg|png';
				$config['max_size'] 		= 1024;
				$config['file_name'] 		= $controller . '-' . uniqid();
				$this->load->library('upload', $config);
				// 
				if (!$this->upload->do_upload('image')) :
					$image = 'default.svg';
				else :
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
					'id' 			=> NULL,
					'password' 		=> $password,
					'email' 		=> $email,
					'name' 			=> $name,
					'image' 		=> $image,
					'status' 		=> $status,
					'id_level' 		=> $level,
					'created_at' 	=> $date,
					'updated_at' 	=> $date
				];
				$this->AdminModel->create($data);
			endif;
			// 
			// insert access
			$details 	= $this->AdminModel->readEmail($email);
			$detail_id 	= $details['id'];
			$data = [];
			foreach ($access as $key) :
				$data[] = [
					'id' 			=> NULL,
					'id_admin' 		=> $detail_id,
					'id_admin_menu' => $key
				];
			endforeach;
			$this->AdminModel->createAccess($data);
			// 
			// flashdata
			$this->session->set_flashdata('alert', 'primary');
			$this->session->set_flashdata('icon', 'fa-check');
			$this->session->set_flashdata('flash', $function . ' <b>' . $flashData . '</b> hasbeen created');
			redirect($controller . '/' . $detail_id);
		endif;
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function update($id)
	{
		// data view
		$this->searching();
		$data			= $this->sessionData();
		$data['title']	= 'create';
		$data['data'] 	= $this->AdminModel->read($id);
		$data['data2'] 	= $this->AdminModel->adminMenu();
		$data['level'] 	= $this->AdminModel->adminLevel();
		// 
		// input
		$email 			= htmlspecialchars($this->input->post('email', true));
		$name 			= htmlspecialchars($this->input->post('name', true));
		$status 		= htmlspecialchars($this->input->post('status', true));
		$level 			= htmlspecialchars($this->input->post('level', true));
		$access 		= $this->input->post('access', true);
		$date 			= date("Y-m-d H:i:s");
		$folder 		= './assets/admin/';
		$thumbnail		= 'thumbnail/';
		$flashData		= $name;
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		$details 		= $data['data'];
		$detail_id 		= $details['id'];
		$detail_email 	= $details['email'];
		$detail_image 	= $details['image'];
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
				'field' => 'access[]',
				'rules' => 'required|trim'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/admin/update', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			// 
			// update
			if (isset($_FILES['image']['name'])) :
				$config['upload_path'] 		= $folder;
				$config['allowed_types'] 	= 'jpg|jpeg|png';
				$config['max_size'] 		= 1024;
				$config['file_name'] 		= $controller . '-' . uniqid();
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
					'status' 		=> $status,
					'id_level' 		=> $level,
					'updated_at' 	=> $date
				];
				$this->AdminModel->update($id, $data);
			endif;
			// 
			// hapus access
			$this->AdminModel->deleteAccess($detail_id);
			// 
			// insert access
			$data = [];
			foreach ($access as $key) :
				$data[] = [
					'id' 			=> NULL,
					'id_admin' 		=> $detail_id,
					'id_admin_menu' => $key
				];
			endforeach;
			$this->AdminModel->createAccess($data);
			// 
			// flashdata
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('icon', 'fa-check');
			$this->session->set_flashdata('flash', $function . ' <b>' . $flashData . '</b> hasbeen updated');
			redirect($controller . '/update/' . $detail_id);
		endif;
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function password($id)
	{
		// data view
		$this->searching();
		$data			= $this->sessionData();
		$data['title']	= 'create';
		$data['data'] 	= $this->AdminModel->read($id);
		// 
		// input
		$password = htmlspecialchars(password_hash($this->input->post('password', true), PASSWORD_DEFAULT));
		$date = date("Y-m-d H:i:s");
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		$details 		= $data['data'];
		$detail_id 		= $details['id'];
		$detail_name 	= $details['name'];
		$flashData 		= $detail_name;
		// 
		// form validation
		$valid = [
			array(
				'field' => 'password',
				'rules' => 'required|trim|min_length[6]'
			),
			array(
				'field' => 'confirm',
				'rules' => 'required|trim|matches[password]'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/admin/password', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			// update
			$data = [
				'password' 		=> $password,
				'updated_at' 	=> $date
			];
			$this->AdminModel->update($id, $data);
			// 
			// flashdata
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('icon', 'fa-check');
			$this->session->set_flashdata('flash', 'password', $function . ' <b>' . $flashData . '</b> hasbeen reseted');
			redirect($controller . '/' . $detail_id);
		endif;
	}
}
