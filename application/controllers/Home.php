<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			redirect("login");
		}
		$url = "http://127.0.0.1:8080/runsystemdms/getPG";

		$ch =  curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		curl_close($ch);
		$data = json_decode($data, true);
		// echo "<pre>";
		// print_r($data["pg"][0]);
		// echo"</pre>";
		$data['get'] = $data;
		$this->load->view('partials2/main/page/page_home', $data);	
	}
}
