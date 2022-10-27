<?php
defined('BASEPATH') or exit('No direct script access allowed');

class NavMenu extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		helper_auth();
		$this->load->model('AuthModel');
		$this->load->model('ConfigsModel');
		$this->load->model('NavMenuModel');
	}


	public function sessionData()
	{
		$session_id 		= $this->session->userdata('id_app');
		$function 			= 'nav menu';
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
		$data 				= $this->sessionData();
		$data['title'] 		= '';
		$data['data'] 		= $this->NavMenuModel->index();

		$this->load->view('administrator/template/header', $data);
		$this->load->view('administrator/nav-menu/index', $data);
		$this->load->view('administrator/template/footer', $data);
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function create()
	{
		// data view
		$data			= $this->sessionData();
		$data['title']	= 'create';
		// 
		// input
		$menu 		= htmlspecialchars($this->input->post('menu', true));
		$slug 		= url_title($menu, 'dash', TRUE);
		$link 		= htmlspecialchars($this->input->post('link', true));
		$date 		= date("Y-m-d H:i:s");
		$flashdata 	= $menu;
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		// 
		// form validation
		$valid = [
			array(
				'field' => 'menu',
				'rules' => 'required|trim|is_unique[tbl_nav_menu.menu]'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/nav-menu/create', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			$data = [
				'id' 			=> NULL,
				'id_menu' 		=> 0,
				'menu' 			=> $menu,
				'slug' 			=> $slug,
				'link' 			=> $link,
				'created_at' 	=> $date,
				'updated_at' 	=> $date
			];
			$this->NavMenuModel->create($data);
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

	public function createSub($id)
	{
		// data view
		$data			= $this->sessionData();
		$data['title']	= 'create sub';
		$data['data'] 	= $this->NavMenuModel->read($id);
		// 
		// 
		// input
		$menu 		= htmlspecialchars($this->input->post('menu', true));
		$slug 		= url_title($menu, 'dash', TRUE);
		$link 		= htmlspecialchars($this->input->post('link', true));
		$date 		= date("Y-m-d H:i:s");
		$flashdata 	= $menu;
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		$details 		= $data['data'];
		$detail_id 		= $details['id'];
		// 
		// form validation
		$valid = [
			array(
				'field' => 'menu',
				'rules' => 'required|trim|is_unique[tbl_nav_menu.menu]'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/nav-menu/create-sub', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			$data = [
				'id_menu' 		=> $detail_id,
				'menu' 			=> $menu,
				'slug' 			=> $slug,
				'link' 			=> $link,
				'created_at' 	=> $date,
				'updated_at' 	=> $date
			];
			$this->NavMenuModel->create($data);
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
		$data			= $this->sessionData();
		$data['data']	= $this->NavMenuModel->read($id);
		$data['title']	= 'update';
		// 
		// input
		$menu 		= htmlspecialchars($this->input->post('menu', true));
		$slug 		= url_title($menu, 'dash', TRUE);
		$link 		= htmlspecialchars($this->input->post('link', true));
		$date 		= date("Y-m-d H:i:s");
		$flashdata 	= $menu;
		// 
		// details
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		$details 		= $data['data'];
		$detail_menu 	= $details['menu'];
		// 
		// form validation
		if ($detail_menu == $menu) :
			$unique_1 = '';
		else :
			$unique_1 = '|is_unique[tbl_nav_menu.menu]';
		endif;
		// 
		$valid = [
			array(
				'field' => 'menu',
				'rules' => 'required|trim' . $unique_1
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/nav-menu/update', $data);
			$this->load->view('administrator/template/footer', $data);
		else :
			$data = [
				'menu' 			=> $menu,
				'slug' 			=> $slug,
				'link' 			=> $link,
				'updated_at' 	=> $date
			];
			$this->NavMenuModel->update($id, $data);
			// 
			// flashdata
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('icon', 'fa-check');
			$this->session->set_flashdata('flash', $function . ' <b>' . $flashdata . '</b> hasbeen updated');
			redirect($controller . '/update/' . $slug);
		endif;
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function delete($id)
	{
		// data view
		$data			= $this->sessionData();
		$data['data']	= $this->NavMenuModel->read($id);
		$data['title']	= 'delete';
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		$details 		= $data['data'];
		$detail_menu 	= $details['menu'];
		$flashdata 		= $detail_menu;
		// 
		// delete
		$this->NavMenuModel->delete($id);
		// 
		// flashdata
		$this->session->set_flashdata('alert', 'danger');
		$this->session->set_flashdata('icon', 'fa-trash');
		$this->session->set_flashdata('flash', $function . ' <b>' . $flashdata . '</b> hasbeen deleted');
		redirect($controller);
	}
}
