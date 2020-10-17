<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	
	public function index()
	{
		$this->load->view('partials2/login/page/page');
	}

	function session()
	{
		$usercode= $this->input->post("usercode");
		$username= $this->input->post("username");
		$grpcode= $this->input->post("grpcode");
		$status= $this->input->post("status");
		$exp= $this->input->post("exp");

		$data = array(
			'usercode' 	=> $usercode,
			'username' 	=> $username,
			'grpcode'		=> $grpcode,
			'status'		=> $status,
			'exp'		=> $exp
		);
		$this->session->set_userdata($data);
		$message = array('message' => true);
		echo json_encode($message);
	}
	function logout()
	{
		$this->session->sess_destroy();
		redirect("login");
	}

	
	
}
