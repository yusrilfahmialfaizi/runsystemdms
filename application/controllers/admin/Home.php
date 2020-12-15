<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "002" && $this->session->userdata('privilegecode') != "001") {
			redirect("login");
		}
		$this->load->view('partials2/main/page2/page_home');
	}
}
?>