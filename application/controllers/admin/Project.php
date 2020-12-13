<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("documentdtl");
		$this->load->library("api");
	}
	
	public function index()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$url = "http://127.0.0.1:8080/runsystemdms/getPG";
		$response = $this->api->get($url);
		$data = json_decode($response, true);
		if ($data == null ) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			}else{
				$data['dt'] = $data['pg'];
				$this->load->view('partials2/main/page2/page_project2',$data);
			}
		}
	}
	public function add_project()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$this->load->view('partials2/main/page2/page_add_project');
	}
	public function edit_project()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$projectcode = $this->input->get("projectcode");
		$url = "http://127.0.0.1:8080/runsystemdms/getProjectById/".$projectcode;
		$response = $this->api->get($url);
		$response = json_decode($response, true);
		if ($response == null ) {
			$this->load->view('partials2/main/page2/page_notfound'); //|| $response['message'] == "Not Found"
		}else{
			if (isset($response['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			}else{
				$data['dt'] = $response["pg"];
				$this->load->view('partials2/main/page2/page_edit_project', $data);
			}
		}
	}

	function add(){
		$projectcode 		= $this->input->post('projectcode');
		$projectname 		= $this->input->post('projectname');
		$actind 			= $this->input->post('actind');
		$ctcode 			= $this->input->post('ctcode');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'projectcode' 	=> $projectcode,
			'projectname'	=> $projectname,
			'actind'		=> $actind,
			'ctcode'		=> $ctcode,
			"CreateBy" 	=> $this->session->userdata("usercode"),
			"CreateDt" 	=> $now,
		);
		$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postProject", $data);
		redirect(base_url('admin/project2'));
	}
	function edit(){
		$projectcode 		= $this->input->post('projectcode');
		$projectname 		= $this->input->post('projectname');
		$actind 			= $this->input->post('actind');
		$ctcode 			= $this->input->post('ctcode');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'projectcode' 	=> $projectcode,
			'projectname'	=> $projectname,
			'actind'		=> $actind,
			'ctcode'		=> $ctcode,
			"LastupBy" 	=> $this->session->userdata("usercode"),
			"LastupDt" 	=> $now,
		);
		print_r($data);
		$this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateProject", $data);
		redirect(base_url('admin/project2'));
	}

	function delete_project()
	{
		$projectcode = $this->input->get("projectcode");
		echo $projectcode;
		$url = "http://127.0.0.1:8080/runsystemdms/deleteProject?projectcode=" . $projectcode;
		$this->api->delete($url);
		redirect(base_url('admin/menu'));
	}
}
