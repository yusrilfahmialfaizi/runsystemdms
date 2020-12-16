<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function index()
    {
		if ($this->session->userdata('status') == "login") {
			if ($this->session->userdata('previlegecode') == "001") {
				# code...
				redirect(base_url("admin/home"));
			}
		}
        $this->load->view('partials2/login_admin/login');
    }

    
	function session()
	{
		$usercode 	= $this->input->post("usercode");
		$username 	= $this->input->post("username");
		$privilegecode	= $this->input->post("privilegecode");
		$grpcode 		= $this->input->post("grpcode");
		$status 		= $this->input->post("status");

		$data = array(
			'usercode' 	=> $usercode,
			'username' 	=> $username,
			'privilegecode'=> $privilegecode,
			'grpcode'		=> $grpcode,
			'status'		=> $status
		);
		$this->session->set_userdata($data);
		$message = array('message' => true);
		echo json_encode($message);
    }
    
	function logout()
	{
		$this->session->sess_destroy();
		redirect("admin/login");
	}
}
