<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Privilege extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("documentdtl");
		$this->load->library("api");
	}
	
	public function index()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "002" && $this->session->userdata('privilegecode') != "001") {
			redirect("admin/login");
		}
		$url 		= "http://127.0.0.1:8080/runsystemdms/getPrivileges";
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		// || $data['message'] == 'Internal Server Error'
		if ($data == null ) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			}else{
				$data['dt'] = $data['privilege'];
				$this->load->view('partials2/main/page2/page_privilege',$data);
			}
		}

	}
	public function Add_privilege()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "002" && $this->session->userdata('privilegecode') != "001") {
			redirect("admin/login");
		}
		
		$this->load->view('partials2/main/page2/page_add_privilege');
	}

	public function edit_privilege()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "002" && $this->session->userdata('privilegecode') != "001") {
			redirect("admin/login");
		}
		$privilegecode 	= $this->input->get("privilegecode");
		$url 		= "http://127.0.0.1:8080/runsystemdms/getPrivilegesById/".$privilegecode;
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		
		if ($data != null) {
			$data['dt'] 	= $data['privilege'];
			$this->load->view('partials2/main/page2/page_edit_privilege', $data);
		}else{
			$this->load->view('partials2/main/page2/page_notfound');
		}
	}

	function add(){
		$privilegecode 		= $this->input->post('privilegecode');
		$privilegename 		= $this->input->post('privilegename');
		date_default_timezone_set('Asia/Jakarta');
		$now 			= date('YmdHi');
		$data 			= array(
			'privilegecode' 	=> $privilegecode,
			'privilegename'	=> $privilegename,
			"CreateBy" 		=> $this->session->userdata("usercode"),
			"CreateDt" 		=> $now,
		);
		$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postPrivileges", $data);
		redirect(base_url('admin/privilege'));
	}
	function edit(){
		$privilegecode 		= $this->input->post('privilegecode');
		$privilegecode_old 		= $this->input->post('privilegecode_old');
		$privilegename 		= $this->input->post('privilegename');
		date_default_timezone_set('Asia/Jakarta');
		$now 			= date('YmdHi');
		$data 			= array(
			'privilegeCode' 	=> $privilegecode,
			'privilegename'	=> $privilegename,
			"LastupBy" 		=> $this->session->userdata("usercode"),
			"LastupDt" 		=> $now,
			'PrivilegeCode_old'	=> $privilegecode_old
		);
		$this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updatePrivileges", $data);
		redirect(base_url('admin/privilege'));
	}

	function delete()
	{
		$privilegecode 	= $this->input->get("privilegecode");
		$url 			= "http://127.0.0.1:8080/runsystemdms/deletePrivileges?privilegecode=" . $privilegecode;
		$this->api->delete($url);
		redirect(base_url('admin/privilege'));
	}
}
