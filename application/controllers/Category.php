<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Category extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		helper_auth();
		$this->load->model('AuthModel');
		$this->load->model('ConfigsModel');
		$this->load->model('CategoryModel');
	}

	public function sessionData()
	{
		$session_id 		= $this->session->userdata('id_app');
		$function 			= 'category';
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
		$config['total_rows'] 	= $this->CategoryModel->pagination($keyword);
		$config['per_page'] 	= 10;
		$config['num_links'] 	= 2;
		$this->pagination->initialize($config);
		$data['total_result'] 	= $config['total_rows'];
		$data['start'] 			= $this->uri->segment(3);
		$data['data'] 			= $this->CategoryModel->index($config['per_page'], $data['start'], $keyword);
		// 
		// view
		$this->load->view('administrator/template/header', $data);
		$this->load->view('administrator/category/index', $data);
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
		$data['data']	= $this->CategoryModel->read($id);
		$data['title']	= 'detail';
		// 
		// view
		$this->load->view('administrator/template/header', $data);
		$this->load->view('administrator/category/read', $data);
		$this->load->view('administrator/template/footer', $data);
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function delete($id)
	{
		// data view
		$data			= $this->sessionData();
		$data['title']	= 'delete';
		$data['data']	= $this->CategoryModel->read($id);
		// 
		// details
		$controller 		= $data['controller'];
		$function 			= $data['function'];
		$details 			= $data['data'];
		$detail_category 	= $details['category'];
		$flashdata 			= $detail_category;
		// 
		// delete
		$this->CategoryModel->delete($id);
		// 
		// flashdata
		$this->session->set_flashdata('alert', 'danger');
		$this->session->set_flashdata('icon', 'fa-trash');
		$this->session->set_flashdata('flash', $function . ' <b>' . $flashdata . '</b> hasbeen deleted');
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
		// 
		// input
		$category 		= htmlspecialchars($this->input->post('category', true));
		$slug 			= url_title($category, 'dash', true);
		$date 			= date("Y-m-d H:i:s");
		$flashdata 		= $category;
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		// 
		// form validation
		$valid = [
			array(
				'field' => 'category',
				'rules' => 'required|trim|is_unique[tbl_articles_categorys.category]'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/category/create', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			// 
			// create
			$data = [
				'id' 			=> NULL,
				'category' 		=> $category,
				'slug' 			=> $slug,
				'created_at' 	=> $date,
				'updated_at' 	=> $date
			];
			$this->CategoryModel->create($data);
			// 
			// flashdata
			$this->session->set_flashdata('alert', 'primary');
			$this->session->set_flashdata('icon', 'fa-check');
			$this->session->set_flashdata('flash', $function . ' <b>' . $flashdata . '</b> hasbeen created');
			redirect($controller);
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
		$data['data']	= $this->CategoryModel->read($id);
		$data['title']	= 'update';
		// 
		// input
		$category 		= htmlspecialchars($this->input->post('category', true));
		$slug 			= url_title($category, 'dash', true);
		$date 			= date("Y-m-d H:i:s");
		$flashdata 		= $category;
		// 
		// details
		$controller 		= $data['controller'];
		$function 			= $data['function'];
		$details 			= $data['data'];
		$detail_category	= $details['category'];
		// 
		// form validation
		if ($detail_category == $category) :
			$unique_category = '';
		else :
			$unique_category = '|is_unique[tbl_articles_categorys.category]';
		endif;
		// 
		$valid = [
			array(
				'field' => 'category',
				'rules' => 'required|trim' . $unique_category
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/category/update', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			// 
			// update
			$data = [
				'category' 		=> $category,
				'slug' 			=> $slug,
				'updated_at' 	=> $date
			];
			$this->CategoryModel->update($id, $data);
			// 
			// flashdata
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('icon', 'fa-check');
			$this->session->set_flashdata('flash', $function . ' <b>' . $flashdata . '</b> hasbeen updated');
			redirect($controller . '/update/' . $slug);
		endif;
	}
}
