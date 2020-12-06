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
		$url 		= 'http://127.0.0.1:8080/runsystemdms/getGroup';
		$response 	= $this->api->get($url);
		$data 		= json_decode($response, true);
		$data['dt'] 	= $data['group'];
		$url1 		= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response1	= $this->api->get($url1);
		$data1		= json_decode($response1, true);
		$data['menu'] 	= $data1['menu'];
		$this->load->view('partials2/main/page2/page_add_groupmenu', $data);
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
		$this->load->view('partials2/main/page2/page_edit_groupmenu', $data);
	}

	function add(){
		$menucode 		= $this->input->post('menucode');
		$grpcode 		= $this->input->post('grpcode');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'menucode' 	=> $menucode,
			'grpcode'		=> $grpcode,
			"CreateBy" 	=> $this->session->userdata("usercode"),
			"CreateDt" 	=> $now,
		);
		print_r($data);
		// $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postProject", $data);
		// redirect(base_url('admin/groupmenu'));
	}
	function edit(){
		$menucode 		= $this->input->post('menucode');
		$grpcode 			= $this->input->post('grpcode');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'menucode' 	=> $menucode,
			'grpcode'		=> $grpcode,
			"LastupBy" 	=> $this->session->userdata("usercode"),
			"LastupDt" 	=> $now,
		);
		print_r($data);
		// $this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateProject", $data);
		// redirect(base_url('admin/groupmenu'));
	}

}
?>