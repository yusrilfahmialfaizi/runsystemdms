<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class GroupMenu extends CI_Controller {

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
		$url = "http://127.0.0.1:8080/runsystemdms/getGroupMenu";
		$response = $this->api->get($url);
		$data = json_decode($response, true);
		$data['dt'] = $data['groupmenu'];
		$this->load->view('partials2/main/page2/page_groupmenu',$data);
	}
	public function add_groupmenu()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$this->load->view('partials2/main/page2/page_add_groupmenu');
	}
	public function edit_groupmenu()
	{
		$projectcode = $this->input->get("projectcode");
		$url = "http://127.0.0.1:8080/runsystemdms/getProjectById/".$projectcode;
		$response = $this->api->get($url);
		$response = json_decode($response, true);
		$data['dt'] = $response["pg"];
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$this->load->view('partials2/main/page2/page_edit_groupmenu', $data);
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
		redirect(base_url('admin/project'));
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
		redirect(base_url('admin/project'));
	}

}
?>