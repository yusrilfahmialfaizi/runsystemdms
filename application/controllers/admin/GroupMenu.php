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
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$url = "http://127.0.0.1:8080/runsystemdms/getGroupMenu";
		$response = $this->api->get($url);
		$data = json_decode($response, true);
		$data['dt'] = $data['groupmenu'];
		if ($data != null) {
			$this->load->view('partials2/main/page2/page_groupmenu2', $data);
		} else {
			$this->load->view('partials2/main/page2/page_notfound');
		}
	}
	public function add_groupmenu()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$url 		= 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		$data['dt'] 	= $data['group'];
		$url1 		= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response1	= $this->api->get($url1);
		$data1		= json_decode($response1, true);
		$data['menu'] 	= $data1['menu'];
		if ($data != null && $data1 != null) {
			$this->load->view('partials2/main/page2/page_add_groupmenu', $data);
		} else {
			$this->load->view('partials2/main/page2/page_notfound');
		}
	}
	public function edit_grpmenu()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$menucode 	= $this->input->get("menucode");
		$grpcode 		= $this->input->get("grpcode");
		$url 		= 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		$data['dt'] 	= $data['group'];
		$url1 		= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response1	= $this->api->get($url1);
		$data1		= json_decode($response1, true);
		$data['menu'] 	= $data1['menu'];
		$url2 		= "http://127.0.0.1:8080/runsystemdms/getGroupMenuById";
		$dt 			= array('menucode' => $menucode, 'grpcode' => $grpcode);
		$response2	= $this->documentdtl->callApiDocDtl("POST", $url2, $dt);
		$data2		= json_decode($response2, true);
		$data['grpmn'] = $data2['groupmenu'];
		if ($data != null && $data1 != null && $data2 != null) {
			$this->load->view('partials2/main/page2/page_edit_groupmenu', $data);
		} else {
			$this->load->view('partials2/main/page2/page_notfound');
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
		$menucode 		= $this->input->post('menucode');
		$grpcode 		= $this->input->post('grpcode');
		$accessind		= $this->input->post("accessind");
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
