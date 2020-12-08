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
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$url1 			= "http://127.0.0.1:8080/runsystemdms/getModuls";
		$response1 		= $this->api->get($url1);
		$data1			= json_decode($response1, true);
		$data['dt'] 		= $data1['modul'];
		if ($data != null) {
			$this->load->view('partials2/main/page2/page_module2', $data);
		} else {
			$this->load->view('partials2/main/page2/page_notfound');
		}
	}
	public function Add_modul()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$url 				= "http://127.0.0.1:8080/runsystemdms/getPG";
		$response 			= $this->api->get($url);
		$data 				= json_decode($response, true);
		$data['project'] 	= $data['pg'];
		if ($data != null) {
			$this->load->view('partials2/main/page2/page_add_modul', $data);
		} else {
			$this->load->view('partials2/main/page2/page_notfound');
		}
	}
	public function edit_module()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$modulcode 		= $this->input->get("modulcode");
		$url 			= "http://127.0.0.1:8080/runsystemdms/getModulByID/" . $modulcode;
		$response 		= $this->api->get($url);
		$response 		= json_decode($response, true);
		$data['dt'] 		= $response["modul"];
		$url2 			= "http://127.0.0.1:8080/runsystemdms/getPG";
		$response2 		= $this->api->get($url2);
		$data2 			= json_decode($response2, true);
		$data['project'] 	= $data2['pg'];
		if ($response != null && $response2 != null) {
			$this->load->view('partials2/main/page2/page_edit_modul', $data);
		} else {
			$this->load->view('partials2/main/page2/page_notfound');
		}
	}
	function add()
	{
		$modulcode 		= $this->input->post('modulcode');
		$modulname 		= $this->input->post('modulname');
		$projectcode 		= $this->input->post('projectcode');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
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
		$modulcode 		= $this->input->post('modulcode');
		$modulname 		= $this->input->post('modulname');
		$projectcode 		= $this->input->post('projectcode');
		$modulcode_old 	= $this->input->post('modulcode_old');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'modulcode' 	=> $modulcode,
			'modulname'	=> $modulname,
			'projectcode' 	=> $projectcode,
			"LastupBy" 	=> $this->session->userdata("usercode"),
			"LastupDt" 	=> $now,
			'modulcode_old' 	=> $modulcode_old,
		);
		$this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateModuls", $data);
		redirect(base_url('admin/module'));
	}

	function delete_modul()
	{
		$modulcode = $this->input->get("modulcode");
		echo $modulcode;
		$url = "http://127.0.0.1:8080/runsystemdms/deleteModule?modulcode=" . $modulcode;
		$this->api->delete($url);
		redirect(base_url('admin/module'));
	}
}
