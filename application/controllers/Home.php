<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function index()
	{
		// if ($this->session->userdata('status') != "login") {
		// 	redirect("login");
		// }
		$this->load->view('partials2/main/header/header_admin');
		$this->load->view('content/admin/content_home');
		$this->load->view('partials2/main/footer');
		
	}

	
	
}
