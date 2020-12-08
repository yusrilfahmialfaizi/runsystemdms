<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Menu2 extends CI_Controller {

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
		$url 	= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response	= $this->api->get($url);
		$data = json_decode($response, true);
		$data['dt'] = $data['menu'];
		$this->load->view('partials2/main/page2/page_menu2',$data);
	}
	public function Add_modul_menu()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$url 			= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response			= $this->api->get($url);
		$data			 = json_decode($response, true);
		$data['menu'] 		= $data['menu'];
		$url1 			= "http://127.0.0.1:8080/runsystemdms/getModuls";
		$response1 		= $this->api->get($url1);
		$data1			= json_decode($response1, true);
		$data['dt'] 		= $data1['modul'];
		$this->load->view('partials2/main/page2/page_add_modul_menu', $data);
	}
	public function edit_menu()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$menucode			= $this->input->get("menucode");
		$url 			= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response			= $this->api->get($url);
		$data			 = json_decode($response, true);
		$data['menu'] 		= $data['menu'];
		$url1 			= "http://127.0.0.1:8080/runsystemdms/getModuls";
		$response1 		= $this->api->get($url1);
		$data1			= json_decode($response1, true);
		$data['dt'] 		= $data1['modul'];
		$url2 			= "http://127.0.0.1:8080/runsystemdms/getMenuWithId/".$menucode;
		$response2 		= $this->api->get($url2);
		$data1			= json_decode($response2, true);
		$data['data'] 		= $data1['menu'];
		$this->load->view('partials2/main/page2/page_edit_modul_menu', $data);
	}

	function add()
	{
		$menucode 		= $this->input->post('menucode');
		$modulcode 		= $this->input->post('modulcode');
		$menudesc 		= $this->input->post('menudesc');
		$parent 			= $this->input->post('parent');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			'menucode' 	=> $menucode,
			'modulcode' 	=> $modulcode,
			'menudesc'	=> $menudesc,
			'parent' 		=> $parent,
			"CreateBy" 	=> $this->session->userdata("usercode"),
			"CreateDt" 	=> $now,
		);
		$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postMenu", $data);
		redirect(base_url('admin/menu2'));
	}
	function edit()
	{
		$menucode 		= $this->input->post('menucode');
		$modulcode 		= $this->input->post('modulcode');
		$menudesc 		= $this->input->post('menudesc');
		$parent 			= $this->input->post('parent');
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$menucode_old 		= $this->input->post('menucode_old');
		$data = array(
			'menucode' 	=> $menucode,
			'modulcode' 	=> $modulcode,
			'menudesc'	=> $menudesc,
			'parent' 		=> $parent,
			"LastupBy" 	=> $this->session->userdata("usercode"),
			"LastupDt" 	=> $now,
			'menucode_old'	=> $menucode_old,
		);
		$this->documentdtl->callApiDocDtl("PUT", "http://127.0.0.1:8080/runsystemdms/updateMenu", $data);
		redirect(base_url('admin/menu2'));
	}

	public function Add_group()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$this->load->view('partials2/main/page2/page_add_group');
	}
	public function Add_group_menu()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
			redirect("login");
		}
		$this->load->view('partials2/main/page2/page_add_group_menu');
	}
}
?>