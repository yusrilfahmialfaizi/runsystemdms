<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

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
		$url 		= "http://127.0.0.1:8080/runsystemdms/getUsers";
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		if ($data == null  || $data['message'] == 'Internal Server Error') {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			$data['dt'] = $data['user'];
			$this->load->view('partials2/main/page2/page_user2',$data);
		}

	}
	public function Add_user()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$url 		= 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		if ($data == null  || $data['message'] == 'Internal Server Error') {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			$data['dt'] = $data['group'];
			$this->load->view('partials2/main/page2/page_add_user', $data);
		}
	}

	public function edit_user()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$usercode 	= $this->input->get("usercode");
		$url 		= 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		$url1 		= "http://127.0.0.1:8080/runsystemdms/getUsersById/".$usercode;
		$response1 	= $this->api->get($url1);
		$data1		= json_decode($response1, true);
		if ($data != null && $data1) {
			$data['dt'] 	= $data['group'];
			$data['user']	= $data1['user'];
			$this->load->view('partials2/main/page2/page_edit_user', $data);
		}else{
			$this->load->view('partials2/main/page2/page_notfound');
		}
	}

	function add(){
		$usercode 		= $this->input->post('usercode');
		$username 		= $this->input->post('username');
		$grpcode 			= $this->input->post('grpcode');
		$pwd 			= $this->input->post('pwd');
		$expdt 			= $this->input->post('expdt');
		date_default_timezone_set('Asia/Jakarta');
		$now 			= date('YmdHi');
		$data 			= array(
			'usercode' 		=> $usercode,
			'username'		=> $username,
			'grpcode'			=> $grpcode,
			'pwd'			=> $pwd,
			'expdt'			=> date('Ymd', strtotime($expdt)),
			'HasQiscusAccount'	=> "0",
			"CreateBy" 		=> $this->session->userdata("usercode"),
			"CreateDt" 		=> $now,
		);
		$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postUsers", $data);
		redirect(base_url('admin/user'));
	}
	function edit(){
		$usercode 		= $this->input->post('usercode');
		$usercode_old 		= $this->input->post('usercode_old');
		$username 		= $this->input->post('username');
		$grpcode 			= $this->input->post('grpcode');
		$pwd 			= $this->input->post('pwd');
		$expdt 			= $this->input->post('expdt');
		$NotifyInd 		= $this->input->post('NotifyInd');
		$HasQiscusAccount 	= $this->input->post('HasQiscusAccount');
		$AvatarImage 		= $this->input->post('AvatarImage');
		$deviceid 		= $this->input->post('deviceid');
		date_default_timezone_set('Asia/Jakarta');
		$now 			= date('YmdHi');
		$data 			= array(
			'UserCode' 		=> $usercode,
			'username'		=> $username,
			'grpcode'			=> $grpcode,
			'pwd'			=> $pwd,
			'expdt'			=> date('Ymd', strtotime($expdt)),
			'NotifyInd'		=> $NotifyInd,
			'HasQiscusAccount'	=> $HasQiscusAccount,
			'AvatarImage'		=> $AvatarImage,
			'deviceid'		=> $deviceid,
			"LastupBy" 		=> $this->session->userdata("usercode"),
			"LastupDt" 		=> $now,
			'UserCode_old'		=> $usercode_old
		);
		$this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateUsers", $data);
		redirect(base_url('admin/user'));
	}

	function delete_user()
	{
		$usercode 	= $this->input->get("usercode");
		$url 		= "http://127.0.0.1:8080/runsystemdms/deleteUser?usercode=" . $usercode;
		$this->api->delete($url);
		redirect(base_url('admin/user'));
	}
}
