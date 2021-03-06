<?php
defined('BASEPATH') or exit('No direct script access allowed');

class GroupMenu extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("documentdtl");
		$this->load->library("api");
	}


	public function index()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "admin") {
			redirect("login");
		}
		$url = "http://127.0.0.1:8080/runsystemdms/getGroupMenu";
		$response = $this->api->get($url);
		$data = json_decode($response, true);
		if ($data == null ) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			} else {
				$data['dt'] = $data['groupmenu'];
				$this->load->view('partials2/main/page2/page_groupmenu2', $data);
			}
		}
	}
	public function add_groupmenu()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "admin") {
			redirect("login");
		}
		$url 		= 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		$url1 		= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response1	= $this->api->get($url1);
		$data1		= json_decode($response1, true);
		if ($data == null && $data1 == null ) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data['message']) || isset($data1['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			} else {
				$data['dt'] 	= $data['group'];
				$data['menu'] 	= $data1['menu'];
				$this->load->view('partials2/main/page2/page_add_groupmenu', $data);
			}
		}
	}
	public function edit_grpmenu()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "admin") {
			redirect("login");
		}
		$menucode 	= $this->input->get("menucode");
		$grpcode 		= $this->input->get("grpcode");
		$url 		= 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		$url1 		= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response1	= $this->api->get($url1);
		$data1		= json_decode($response1, true);
		$url2 		= "http://127.0.0.1:8080/runsystemdms/getGroupMenuById";
		$dt 			= array('menucode' => $menucode, 'grpcode' => $grpcode);
		$response2	= $this->documentdtl->callApiDocDtl("POST", $url2, $dt);
		$data2		= json_decode($response2, true);
		if ($data == null && $data1 == null && $data2 == null) {
			$this->load->view('partials2/main/page2/page_notfound');
		}else{
			if (isset($data['message']) || isset($data1['message']) || isset($data2['message'])) {
				$this->load->view('partials2/main/page2/page_notfound');
			} else {
				$data['dt'] 	= $data['group'];
				$data['menu'] 	= $data1['menu'];
				$data['grpmn'] = $data2['groupmenu'];
				$this->load->view('partials2/main/page2/page_edit_groupmenu', $data);
			}
		}
	}

	function delete_grpmenu()
	{
		$menucode = $this->input->get("menucode");
		$grpcode  = $this->input->get("grpcode");
		echo $grpcode;
		$url = "http://127.0.0.1:8080/runsystemdms/deleteGroupMenu?menucode=" . $menucode . "&grpcode=" . $grpcode;
		$this->api->delete($url);
		redirect(base_url('admin/groupmenu'));
	}

	function add()
	{
		$menucode 	= $this->input->post('menucode');
		$grpcode 		= $this->input->post('grpcode');
		$accessind	= $this->input->post("accessind");
		if ($accessind == null) {
			$accessind = "NNNNN";
		}
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'menucode' 	=> $menucode,
			'grpcode'		=> $grpcode,
			'accessind'	=> $accessind,
			"CreateBy" 	=> $this->session->userdata("usercode"),
			"CreateDt" 	=> $now,
		);
		print_r($data);
		$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postGroupMenu", $data);
		redirect(base_url('admin/groupmenu'));
	}
	function edit()
	{
		$menucode 		= $this->input->post('menucode');
		$grpcode 			= $this->input->post('grpcode');
		$menucode_old 		= $this->input->post('menucode_old');
		$grpcode_old 			= $this->input->post('grpcode_old');
		$accessind		= $this->input->post("accessind");
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'menucode' 	=> $menucode,
			'grpcode'		=> $grpcode,
			'accessind'	=> $accessind,
			"LastupBy" 	=> $this->session->userdata("usercode"),
			"LastupDt" 	=> $now,
			'menucode_old'	=> $menucode_old,
			'grpcode_old'	=> $grpcode_old,
		);
		print_r($data);
		$this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateGroupMenu", $data);
		redirect(base_url('admin/groupmenu'));
	}
}
