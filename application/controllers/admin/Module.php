<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Module extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library('documentdtl');
		$this->load->library('api');
	}

	public function index()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "admin") {
			redirect("login");
		}
		$url1 			= "http://127.0.0.1:8080/runsystemdms/getModuls";
		$response1 		= $this->api->get($url1);
		$data1			= json_decode($response1, true);
		if ($data1 == null ) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data1['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			} else {
				$data['dt'] 	= $data1['modul'];
				$this->load->view('partials2/main/page2/page_module2', $data);
			}
		}
	}
	public function Add_modul()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "admin") {
			redirect("login");
		}
		$url 				= "http://127.0.0.1:8080/runsystemdms/getProject";
		$response 			= $this->api->get($url);
		$data 				= json_decode($response, true);
		if ($data == null ) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			} else {
				$data['project'] 	= $data['pg'];
				$this->load->view('partials2/main/page2/page_add_modul', $data);
			}
		}
	}
	public function edit_module()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "admin") {
			redirect("login");
		}
		$modulcode 		= $this->input->get("modulcode");
		$projectcode		= $this->input->get("projectcode");
		$dt				= array('modulcode'	=> $modulcode, 'projectcode'	=> $projectcode);
		$response 		= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getModulByID", $dt);
		$data 			= json_decode($response, true);
		$url2 			= "http://127.0.0.1:8080/runsystemdms/getPG";
		$response2 		= $this->api->get($url2);
		$data2 			= json_decode($response2, true);
		if ($data == null ) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data['message']) || isset($data2['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			} else {
				$data['dt'] 		= $data["modul"];
				$data['project'] 	= $data2['pg'];
				$this->load->view('partials2/main/page2/page_edit_modul', $data);
			}
		}
	}
	function add()
	{
		$modulcode 		= $this->input->post('modulcode');
		$modulname 		= $this->input->post('modulname');
		$projectcode 		= $this->input->post('projectcode');
		date_default_timezone_set('Asia/Jakarta');
		$now 			= date('YmdHi');
		$data 			= array(
			'modulcode' 	=> $modulcode,
			'modulname'	=> $modulname,
			'projectcode' 	=> $projectcode,
			"CreateBy" 	=> $this->session->userdata("usercode"),
			"CreateDt" 	=> $now,
		);
		$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postModuls", $data);
		redirect(base_url('admin/module'));
	}
	function edit()
	{
		date_default_timezone_set('Asia/Jakarta');
		$modulcode 		= $this->input->post('modulcode');
		$modulname 		= $this->input->post('modulname');
		$projectcode 		= $this->input->post('projectcode');
		$projectcode_old 	= $this->input->post('projectcode_old');
		$modulcode_old 	= $this->input->post('modulcode_old');
		$now 			= date('YmdHi');
		$data 			= array(
			'modulcode' 		=> $modulcode,
			'modulname'		=> $modulname,
			'projectcode' 		=> $projectcode,
			"LastupBy" 		=> $this->session->userdata("usercode"),
			"LastupDt" 		=> $now,
			'projectcode_old' 	=> $projectcode_old,
			'modulcode_old'	=> $modulcode_old,
		);
		$this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateModuls", $data);
		redirect(base_url('admin/module'));
	}

	function delete_modul()
	{
		$modulcode 	= $this->input->get("modulcode");
		$projectcode 	= $this->input->get("projectcode");
		$url 		= "http://127.0.0.1:8080/runsystemdms/deleteModule?modulcode=" . $modulcode . "&projectcode=" . $projectcode;
		$this->api->delete($url);
		redirect(base_url('admin/module'));
	}
}
