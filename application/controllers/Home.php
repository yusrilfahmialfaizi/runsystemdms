<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->library("menu");
	}

	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			redirect("login");
		}
		if ($this->session->userdata("modul") != null) {
			$this->session->unset_userdata('modul');
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
			$data2 = $this->menu->getModulMenu();
			$data2 = json_decode($data2, true);
			$data['sidebar'] = $data2;
			$this->load->view('partials2/main/page/page_home', $data);	
		}else{
			$this->load->view('partials2/main/page/page_error');	
		}
	}
}
