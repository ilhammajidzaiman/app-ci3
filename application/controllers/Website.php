<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Website extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->model('WebsiteModel');
		$this->load->model('ConfigsModel');
	}

	public function sessionData()
	{
		$function 			= '';
		$data = [
			'function' 		=> $function,
			'controller' 	=> url_title($function, 'dash', TRUE),
			'configs'		=> $this->ConfigsModel->index()
		];
		return $data;
	}

	public function searching()
	{
		$search 	= htmlspecialchars($this->input->post('search', true));
		$keyword 	= htmlspecialchars($this->input->post('keyword', true));
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
		$data['menus']	= $this->WebsiteModel->readMenus();
		// 
		// details
		$details	 	= $data['configs'];
		$title	 		= $details['application'];
		$searching		= $this->searching();
		$keyword		= $searching['keyword'];
		// 
		// config pagination
		$this->load->library('pagination');
		$config['base_url'] 	= base_url('') . '/index';
		$config['total_rows'] 	= $this->WebsiteModel->pagination($keyword);
		$config['per_page'] 	= 8;
		$config['num_links'] 	= 2;
		$this->pagination->initialize($config);
		$data['start'] 			= $this->uri->segment(2);
		$data['datas'] 			= $this->WebsiteModel->index($config['per_page'], $data['start'], $keyword);
		$data['total_result'] 	= $config['total_rows'];
		// 
		$data['title'] 			= $title;
		// view
		$this->load->view('website/template/header', $data);
		$this->load->view('website/index', $data);
		$this->load->view('website/template/footer', $data);
	}

	public function read($id)
	{
		// data view
		$this->searching();
		$data 				= $this->sessionData();
		$data['menus']	= $this->WebsiteModel->readMenus();
		$data['data'] 		= $this->WebsiteModel->read($id);
		$data['news'] 		= $this->WebsiteModel->new();
		$data['populars'] 	= $this->WebsiteModel->popular();
		// 
		// details
		$details 				= $data['data'];
		$detail_id		 		= $details['id'];
		$detail_counter 		= $details['counter'];
		$detail_title 			= $details['title'];
		// 
		$data['categorys'] 		= $this->WebsiteModel->readArticleCategory($detail_id);
		$data['title']			= $detail_title;
		// 
		// view
		$this->load->view('website/template/header', $data);
		$this->load->view('website/read', $data);
		$this->load->view('website/template/footer', $data);

		// counter
		$counter = $detail_counter + 1;
		$data = [
			'counter' => $counter
		];
		$this->WebsiteModel->update($id, $data);
	}
}
