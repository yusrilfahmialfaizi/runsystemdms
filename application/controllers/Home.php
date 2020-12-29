<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library("menu");
	}

	public function index()
	{
		if ($this->session->userdata('status') != "login"|| $this->session->userdata('privilegecode') != "user" && $this->session->userdata('privilegecode') != "admin") {
			redirect("login");
		}
		if ($this->session->userdata("modul") != null) {
			$this->session->unset_userdata('modul');
			$this->session->unset_userdata('projectcode');
		}
		$url = "http://127.0.0.1:8080/runsystemdms/getPG";

		$ch =  curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		$eror =  curl_error($ch);
		curl_close($ch);
		if ($eror == null) {
			$data = json_decode($data, true);
			$data['get'] = $data;
			$this->load->view('partials2/main/page/page_home', $data);	
		}else{
			$this->load->view('partials2/main/page/page_error');	
		}
	}
	function session_projectcode(){
		$projectcode = $this->input->post("projectcode");
		$this->session->set_userdata(array("projectcode" => $projectcode));
	}
}
