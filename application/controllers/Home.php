<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			redirect("login");
		}
		$this->module();
		$this->load->view('partials2/main/header/header_admin');
		$this->load->view('content/admin/content_home');
		$this->load->view('partials2/main/footer');
		
	}
	function module(){
		// $result =  json_decode(stripslashes($this->input->post("result")));
		$result = $this->input->post("result");
		

		if ($result != null) {
			print_r($result);
			# code...
			$message = array('message' => true);
			echo json_encode($message);
		}else{
			print_r($result);
			$message = array('message' => false);
			echo json_encode($message);
		}
	}

	
	
}
