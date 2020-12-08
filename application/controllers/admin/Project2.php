<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Project2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("documentdtl");
		$this->load->library("api");
	}
	
	public function index()
	{
		// if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
		// 	redirect("login");
		// }
		$url = "http://127.0.0.1:8080/runsystemdms/getPG";
		$response = $this->api->get($url);
		$data = json_decode($response, true);
		$data['dt'] = $data['pg'];
		$this->load->view('partials2/main/page2/page_project2',$data);
	}
}
?>