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
		$url = "http://127.0.0.1:8080/runsystemdms/getUsers";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$response = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($response, true);
		$data['dt'] = $data['user'];
		if ($data != null) {
			$this->load->view('partials2/main/page2/page_user2',$data);
		}else{
			$this->load->view('partials2/main/page2/page_notfound');
		}

	}
	public function Add_user()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$url = 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$response = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($response, true);
		$data['dt'] = $data['group'];
		if ($data != null) {
			$this->load->view('partials2/main/page2/page_add_user', $data);
		}else{
			$this->load->view('partials2/main/page2/page_notfound');
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
		$data['dt'] 	= $data['group'];
		$url1 		= "http://127.0.0.1:8080/runsystemdms/getUsersById/".$usercode;
		$response1 	= $this->api->get($url1);
		$data1		= json_decode($response1, true);
		$data['user']	= $data1['user'];
		if ($data != null && $data1) {
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
		$now = date('YmdHi');
		$data = array(
			'usercode' 	=> $usercode,
			'username'	=> $username,
			'grpcode'		=> $grpcode,
			'pwd'		=> $pwd,
			'expdt'		=> date('Ymd', strtotime($expdt)),
			"CreateBy" => $this->session->userdata("usercode"),
			"CreateDt" => $now,
		);
		$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postUsers", $data);
		redirect(base_url('admin/user2'));
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
		$now = date('YmdHi');
		$data = array(
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
		echo "<pre>";
		print_r($data);
		echo "</pre>";
		$this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateUsers", $data);
		redirect(base_url('admin/user2'));
	}

	function delete_user()
	{
		$usercode = $this->input->get("usercode");
		echo $usercode;
		$url = "http://127.0.0.1:8080/runsystemdms/deleteUser?usercode=" . $usercode;
		$this->api->delete($url);
		redirect(base_url('admin/menu'));
	}
}
