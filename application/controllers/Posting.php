<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Posting extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		helper_auth();
		$this->load->model('AuthModel');
		$this->load->model('ConfigsModel');
		$this->load->model('PostingModel');
	}

	public function sessionData()
	{
		$session_id 		= $this->session->userdata('id_app');
		$function 			= 'posting';
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
		$data['title'] 	= '';
		// 
		// details
		$controller 	= $data['controller'];
		$profil		 	= $data['profil'];
		$profil_id 		= $profil['id'];
		$profil_level 	= $profil['id_level'];
		$searching		= $this->searching();
		$keyword		= $searching['keyword'];

		// 
		// config pagination
		$this->load->library('pagination');
		$config['base_url'] 	= base_url('') . $controller . '/index';
		$config['total_rows'] 	= $this->PostingModel->pagination($profil_id, $profil_level, $keyword);
		$config['per_page'] 	= 10;
		$config['num_links'] 	= 2;
		$this->pagination->initialize($config);
		$data['start'] 			= $this->uri->segment(3);
		$data['total_result'] 	= $config['total_rows'];
		$data['data'] 			= $this->PostingModel->index($config['per_page'], $data['start'], $profil_id, $profil_level, $keyword);
		// 
		// view
		$this->load->view('administrator/template/header', $data);
		$this->load->view('administrator/posting/index', $data);
		$this->load->view('administrator/template/footer', $data);
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function read($id)
	{
		// data view
		$this->searching();
		$data				= $this->sessionData();
		$data['data']		= $this->PostingModel->read($id);
		$data['title']		= 'detail';
		// 
		// details
		$details 			= $data['data'];
		$detail_id 			= $details['id'];
		$data['categorys'] 	= $this->PostingModel->readArticleCategory($detail_id);
		// 
		// view
		$this->load->view('administrator/template/header', $data);
		$this->load->view('administrator/posting/read', $data);
		$this->load->view('administrator/template/footer', $data);
	}

	// ##################################################
	// ##################################################
	// ##################################################

	public function delete($id)
	{
		// data view
		$this->searching();
		$data			= $this->sessionData();
		$data['data']	= $this->PostingModel->read($id);
		$data['title']	= 'delete';
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		$details 		= $data['data'];
		$detail_id 		= $details['id'];
		$detail_title 	= $details['title'];
		$detail_image 	= $details['image'];
		$flashdata 		= $detail_title;
		$folder 		= './assets/admin/';
		$thumbnail 		= 'thumbnail/';
		// 
		// delete file
		if ($detail_image !== 'default.svg') :
			unlink($folder . $detail_image);
			unlink($folder . $thumbnail . $detail_image);
		endif;
		// 
		// delete
		$this->PostingModel->delete($id);
		// 
		// delete access
		$this->PostingModel->deleteCategory($detail_id);
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
		$data				= $this->sessionData();
		$data['title']		= 'create';
		$data['categorys']	= $this->PostingModel->readCategorys();
		// 
		// input
		$title 			= htmlspecialchars($this->input->post('title', TRUE));
		$slug 			= url_title($title, 'dash', TRUE);
		$article 		= $this->input->post('article', TRUE);
		$status 		= htmlspecialchars($this->input->post('status', TRUE));
		$counter 		= '0';
		$category 		= $this->input->post('category', TRUE);
		$flashdata 		= $title;
		$date 			= date("Y-m-d H:i:s");
		$folder 		= './assets/article/';
		$thumbnail 		= 'thumbnail/';
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		// 
		// form validation
		$valid = [
			array(
				'field' => 'title',
				'rules' => 'required|trim|is_unique[tbl_articles.title]'
			),
			array(
				'field' => 'article',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'category[]',
				'rules' => 'required|trim'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/posting/create', $data);
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
					$config['width'] 			= 400;
					$config['height'] 			= 300;
					$config['maintain_ratio'] 	= FALSE;
					$config['new_image'] 		= $folder . $thumbnail . $data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$image 						= $data_upload['file_name'];
				endif;
				$data = [
					'id' 			=> NULL,
					'title' 		=> $title,
					'slug' 			=> $slug,
					'article' 		=> $article,
					'image' 		=> $image,
					'id_admin' 		=> $this->session->userdata('id_app'),
					'status' 		=> $status,
					'counter' 		=> $counter,
					'created_at' 	=> $date,
					'updated_at' 	=> $date
				];
				$this->PostingModel->create($data);
			endif;
			// 
			// insert access
			$details 	= $this->PostingModel->read($slug);
			$detail_id 	= $details['id'];
			$data = [];
			foreach ($category as $key) :
				$data[] = [
					'id' 					=> NULL,
					'id_article' 			=> $detail_id,
					'id_article_category' 	=> $key
				];
			endforeach;
			$this->PostingModel->createCategory($data);
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
		$data				= $this->sessionData();
		$data['title']		= 'update';
		$data['data']		= $this->PostingModel->read($id);
		$data['categorys']	= $this->PostingModel->readCategorys();
		// 
		// input
		$title 			= htmlspecialchars($this->input->post('title', TRUE));
		$slug 			= url_title($title, 'dash', TRUE);
		$article 		= $this->input->post('article', TRUE);
		$status 		= htmlspecialchars($this->input->post('status', TRUE));
		$category 		= $this->input->post('category', TRUE);
		$flashdata 		= $title;
		$date 			= date("Y-m-d H:i:s");
		$folder 		= './assets/article/';
		$thumbnail 		= 'thumbnail/';
		// 
		// details
		$controller 	= $data['controller'];
		$function 		= $data['function'];
		$details 		= $data['data'];
		$detail_id 		= $details['id'];
		$detail_title 	= $details['title'];
		$detail_image 	= $details['image'];
		// 
		// form validation
		if ($detail_title == $title) :
			$unique_1 = '';
		else :
			$unique_1 = '|is_unique[tbl_articles.title]';
		endif;
		// 
		$valid = [
			array(
				'field' => 'title',
				'rules' => 'required|trim' . $unique_1
			),
			array(
				'field' => 'article',
				'rules' => 'required|trim'
			),
			array(
				'field' => 'category[]',
				'rules' => 'required|trim'
			)
		];
		$this->form_validation->set_rules($valid);
		// 
		// view
		if ($this->form_validation->run() == false) :
			$this->load->view('administrator/template/header', $data);
			$this->load->view('administrator/posting/update', $data);
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
					$config['width'] 			= 400;
					$config['height'] 			= 300;
					$config['maintain_ratio'] 	= FALSE;
					$config['new_image'] 		= $folder . $thumbnail . $data_upload['file_name'];
					$this->load->library('image_lib', $config);
					$this->image_lib->resize();
					$image 						= $data_upload['file_name'];
				endif;
				$data = [
					'title' 		=> $title,
					'slug' 			=> $slug,
					'article' 		=> $article,
					'image' 		=> $image,
					'id_admin' 		=> $this->session->userdata('id_app'),
					'status' 		=> $status,
					'updated_at' 	=> $date
				];
				$this->PostingModel->update($id, $data);
			endif;
			// 
			// hapus access
			$this->PostingModel->deleteCategory($detail_id);
			// 
			// insert access
			$data = [];
			foreach ($category as $key) :
				$data[] = [
					'id' 					=> NULL,
					'id_article' 			=> $detail_id,
					'id_article_category' 	=> $key
				];
			endforeach;
			$this->PostingModel->createCategory($data);
			// 
			// flashdata
			$this->session->set_flashdata('alert', 'success');
			$this->session->set_flashdata('icon', 'fa-check');
			$this->session->set_flashdata('flash', $function . ' <b>' . $flashdata . '</b> hasbeen updated');
			redirect($controller . '/update/' . $slug);
		endif;
	}
}
