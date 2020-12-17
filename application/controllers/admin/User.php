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
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "002" && $this->session->userdata('privilegecode') != "001") {
			redirect("admin/login");
		}
		$url 		= "http://127.0.0.1:8080/runsystemdms/getUsers";
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		// print_r($data);
		// || $data['message'] == 'Internal Server Error'
		if ($data == null ) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			}else{
				$data['dt'] = $data['user'];
				$this->load->view('partials2/main/page2/page_user2',$data);
			}
		}

	}
	public function Add_user()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "002" && $this->session->userdata('privilegecode') != "001") {
			redirect("admin/login");
		}
		$url 		= 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		$url2 		= "http://127.0.0.1:8080/runsystemdms/getPrivileges";
		$response2 	= $this->api->get($url2);
		$data2 		= json_decode($response2, true);
		if ($data == null && $data2 != null) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			}else{		
				$data['dt'] 	= $data['group'];
				$data['prvl']	= $data2['privilege'];
				$this->load->view('partials2/main/page2/page_add_user', $data);
			}
		}
	}

	public function edit_user()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "002" && $this->session->userdata('privilegecode') != "001") {
			redirect("admin/login");
		}
		$usercode 	= $this->input->get("usercode");
		$url 		= 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		$url1 		= "http://127.0.0.1:8080/runsystemdms/getUsersById/".$usercode;
		$response1 	= $this->api->get($url1);
		$data1		= json_decode($response1, true);
		$url2 		= "http://127.0.0.1:8080/runsystemdms/getPrivileges";
		$response2 	= $this->api->get($url2);
		$data2 		= json_decode($response2, true);
		if ($data != null && $data1 != null && $data2 != null) {
			$data['dt'] 	= $data['group'];
			$data['user']	= $data1['user'];
			$data['prvl']	= $data2['privilege'];
			$this->load->view('partials2/main/page2/page_edit_user', $data);
		}else{
			$this->load->view('partials2/main/page2/page_notfound');
		}
	}

	function add(){
			date_default_timezone_set('Asia/Jakarta');
			$usercode 		= $this->input->post('usercode');
			$username 		= $this->input->post('username');
			$privilegecode 	= $this->input->post('privilegecode');
			$grpcode 			= $this->input->post('grpcode');
			$pwd 			= $this->input->post('pwd');
			$expdt 			= $this->input->post('expdt');
			if ($expdt != null) {
				$expdt = date('Ymd', strtotime($expdt));
			}elseif ($expdt == null) {
				$expdt = $expdt;
			}
			$NotifyInd 		= $this->input->post('NotifyInd');
			if ($NotifyInd == null) {
				$NotifyInd = "N";
			}elseif ($NotifyInd == 'on') {
				$NotifyInd = "Y";
			}
			$HasQiscusAccount 	= $this->input->post('HasQiscusAccount');
			if ($HasQiscusAccount == null) {
				$HasQiscusAccount = "0";
			}elseif ($HasQiscusAccount == 'on') {
				$HasQiscusAccount = "1";
			}
			$deviceid 		= $this->input->post('deviceid');
			$now 			= date('YmdHi');
			$config['upload_path']		= './upload/avatarimage/';  // folder upload 
			$config['allowed_types']		= 'gif|jpg|png|jpeg'; // jenis file
			$config['max_size']			= 1024;
			$config['file_name']		= $this->input->post('usercode');
			$config['overwrite']		= true;    
			$this->load->library('upload', $config);
			if (!$this->upload->do_upload('AvatarImage')) //sesuai dengan name pada form 
			{
				if (!empty($_FILES['AvatarImage']['name'])) {
					// Name isn't empty so a file must have been selected
					$message = str_replace("<p>", "",$this->upload->display_errors());
					$message = str_replace("</p>", "",$message);
					echo "<script type='text/javascript'>alert('$message');</script>";
					echo "<script>window.history.back();</script>";
				} else {
					// No file selected - set default image
					$AvatarImage = 'default.png';
					$data 			= array(
						'usercode' 		=> $usercode,
						'username'		=> $username,
						'privilegecode'	=> $privilegecode,
						'grpcode'			=> $grpcode,
						'pwd'			=> $pwd,
						'expdt'			=> $expdt,
						'notifyind'		=> $NotifyInd,
						'HasQiscusAccount'	=> $HasQiscusAccount,
						'AvatarImage'		=> $AvatarImage,
						'deviceid'		=> $deviceid,
						"CreateBy" 		=> $this->session->userdata("usercode"),
						"CreateDt" 		=> $now,
					);
					$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postUsers", $data);
					redirect(base_url('admin/user'));
				}
			}else{
				$file 			= $this->upload->data();
				$AvatarImage 		= $file['file_name'];
				$data 			= array(
					'usercode' 		=> $usercode,
					'username'		=> $username,
					'privilegecode'	=> $privilegecode,
					'grpcode'			=> $grpcode,
					'pwd'			=> $pwd,
					'expdt'			=> $expdt,
					'notifyind'		=> $NotifyInd,
					'HasQiscusAccount'	=> $HasQiscusAccount,
					'AvatarImage'		=> $AvatarImage,
					'deviceid'		=> $deviceid,
					"CreateBy" 		=> $this->session->userdata("usercode"),
					"CreateDt" 		=> $now,
				);			
				$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postUsers", $data);
				redirect(base_url('admin/user'));
			}
			
	}
	function edit(){
		$usercode 		= $this->input->post('usercode');
		$usercode_old 		= $this->input->post('usercode_old');
		$username 		= $this->input->post('username');
		$privilegecode 	= $this->input->post('privilegecode');
		$grpcode 			= $this->input->post('grpcode');
		$pwd 			= $this->input->post('pwd');
		$expdt 			= $this->input->post('expdt');
		if ($expdt != null) {
			$expdt = date('Ymd', strtotime($expdt));
		}elseif ($expdt == null) {
			$expdt = $expdt;
		}
		$NotifyInd 		= $this->input->post('NotifyInd');
		if ($NotifyInd == null) {
			$NotifyInd = "N";
		}elseif ($NotifyInd == 'on') {
			$NotifyInd = "Y";
		}
		$HasQiscusAccount 	= $this->input->post('HasQiscusAccount');
		if ($HasQiscusAccount == null) {
			$HasQiscusAccount = "0";
		}elseif ($HasQiscusAccount == 'on') {
			$HasQiscusAccount = "1";
		}
		$AvatarImage 		= $this->input->post('AvatarImage');
		$deviceid 		= $this->input->post('deviceid');
		date_default_timezone_set('Asia/Jakarta');
		$now 			= date('YmdHi');
		$data 			= array(
			'UserCode' 		=> $usercode,
			'username'		=> $username,
			'privilegecode'	=> $privilegecode,
			'grpcode'			=> $grpcode,
			'pwd'			=> $pwd,
			'expdt'			=> $expdt,
			'NotifyInd'		=> $NotifyInd,
			'HasQiscusAccount'	=> $HasQiscusAccount,
			'AvatarImage'		=> $AvatarImage,
			'deviceid'		=> $deviceid,
			"LastupBy" 		=> $this->session->userdata("usercode"),
			"LastupDt" 		=> $now,
			'UserCode_old'		=> $usercode_old
		);
		// $this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateUsers", $data);
		// redirect(base_url('admin/user'));
	}

	function delete_user()
	{
		$usercode 	= $this->input->get("usercode");
		$url 		= "http://127.0.0.1:8080/runsystemdms/deleteUser?usercode=" . $usercode;
		$this->api->delete($url);
		redirect(base_url('admin/user'));
	}

// 	private function uploadImage($AvatarImage)
// 	{
// 		$config['upload_path']		='./upload/avatarimage/';
// 		$config['allowed_types']		= 'gif|jpg|png';
// 		$config['file_name']		= $AvatarImage;
// 		$config['overwrite']		= true;
// 		$config['max_size']           = 1024; // 1MB
// 		// $config['max_width']       = 1024;
// 		// $config['max_height']      = 768;

// 		$this->load->library('upload', $config);

// 		if ($this->upload->do_upload('avatarimage')) {
// 			return $this->upload->data("file_name");
// 		}
		
// 		return "default.png";
// 	}
// }
}