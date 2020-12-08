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
		// if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "SysAdm") {
		// 	redirect("login");
		// }
		$url 	= "http://127.0.0.1:8080/runsystemdms/getMenu";
		$response	= $this->api->get($url);
		$data = json_decode($response, true);
		$data['dt'] = $data['menu'];
		$this->load->view('partials2/main/page2/page_menu2',$data);
	}
}
?>