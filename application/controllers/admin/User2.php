<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User2 extends CI_Controller {

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
		$url = "http://127.0.0.1:8080/runsystemdms/getUsers";
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$response = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($response, true);
		$data['dt'] = $data['user'];

		$this->load->view('partials2/main/page2/page_user2',$data);
	}
}
?>