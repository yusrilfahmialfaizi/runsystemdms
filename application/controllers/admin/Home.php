<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

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
		$data		= $data['user'];
		$count_user 	= count($data);
		$data['user']	= $count_user;

		$url1 		= "http://127.0.0.1:8080/runsystemdms/getPrivileges";
		$response1 	= $this->api->get($url1);
		$data1 		= json_decode($response1, true);
		$data1		= $data1['privilege'];
		$count_prv 	= count($data1);
		$data['prv']	= $count_prv;

		$url2 		= "http://127.0.0.1:8080/runsystemdms/getProject";
		$response2 	= $this->api->get($url2);
		$data2 		= json_decode($response2, true);
		$data2		= $data2['pg'];
		$count_prj 	= count($data2);
		$data['prj']	= $count_prj;

		$url3 		= "http://127.0.0.1:8080/runsystemdms/getModuls";
		$response3 	= $this->api->get($url3);
		$data3 		= json_decode($response3, true);
		$data3		= $data3['modul'];
		$count_modul 	= count($data3);
		$data['modul']	= $count_modul;

		$url4 		= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response4 	= $this->api->get($url4);
		$data4 		= json_decode($response4, true);
		$data4		= $data4['menu'];
		$count_menu 	= count($data4);
		$data['menu']	= $count_menu;

		$url5 		= "http://127.0.0.1:8080/runsystemdms/getGroupMenu";
		$response5 	= $this->api->get($url5);
		$data5 		= json_decode($response5, true);
		$data5		= $data5['groupmenu'];
		$count_gm 	= count($data5);
		$data['gm']	= $count_gm;

		$url6 		= "http://127.0.0.1:8080/runsystemdms/getGroup";
		$response6 	= $this->api->get($url6);
		$data6 		= json_decode($response6, true);
		$data6		= $data6['group'];
		$count_group 	= count($data6);
		$data['group']	= $count_group;

		$this->load->view('partials2/main/page2/page_home', $data);
	}
}
?>