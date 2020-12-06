<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Group extends CI_Controller {

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
		$url = "http://127.0.0.1:8080/runsystemdms/getGroup";
		$response = $this->api->get($url);
		$data = json_decode($response, true);
		$data['dt'] = $data['group'];
		$this->load->view('partials2/main/page2/page_group',$data);
	}
	public function add_group()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$this->load->view('partials2/main/page2/page_add_group');
	}
	public function edit_grp()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$grpcode = $this->input->get("grpcode");
		$url = "http://127.0.0.1:8080/runsystemdms/getGroupById/".$grpcode;
		$response = $this->api->get($url);
		$response = json_decode($response, true);
		$data['dt'] = $response["group"];
		$this->load->view('partials2/main/page2/page_edit_group', $data);
	}

	function add(){
		$grpcode 		= $this->input->post('grpcode');
		$grpname 		= $this->input->post('grpname');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'grpcode' 	=> $grpcode,
			'grpname'		=> $grpname,
			"CreateBy" 	=> $this->session->userdata("usercode"),
			"CreateDt" 	=> $now,
		);
		print_r($data);
		// $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postProject", $data);
		// redirect(base_url('admin/group'));
	}
	function edit(){
		$grpcode 		= $this->input->post('grpcode');
		$grpname 		= $this->input->post('grpname');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'grpcode' 	=> $grpcode,
			'grpname'		=> $grpname,
			"LastupBy" 	=> $this->session->userdata("usercode"),
			"LastupDt" 	=> $now,
		);
		print_r($data);
		// $this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateProject", $data);
		// redirect(base_url('admin/group'));
	}

}
?>