<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Module2 extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library('documentdtl');
		$this->load->library('api');
	}
	
	public function index()
	{
		// if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
		// 	redirect("login");
		// }
		$url1 			= "http://127.0.0.1:8080/runsystemdms/getModuls";
		$response1 		= $this->api->get($url1);
		$data1			= json_decode($response1, true);
		$data['dt'] 		= $data1['modul'];
		$this->load->view('partials2/main/page2/page_module2',$data);
	}
}
?>