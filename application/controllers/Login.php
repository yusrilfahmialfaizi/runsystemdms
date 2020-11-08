<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{


	public function index()
	{
		if ($this->session->userdata('status') == "login") {
			redirect("home");
		}
		$this->load->view('partials2/login/page');
	}
	// function log_in(){
	// 	$url = 'http://127.0.0.1:8080/runsystemdms/login';
	// 	$usercode = $this->input->post("usercode");
	// 	$pwd = $this->input->post("pwd");
	// 	$data = ["usercode" => $usercode, "pwd" => $pwd];


	// 	$ch = curl_init();
	// 	curl_setopt($ch, CURLOPT_POST, 1);
	// 	curl_setopt($ch, CURLOPT_POSTFIELDS, array("usercode" =>$usercode,"pwd"=>$pwd)); //pass encoded JSON string to post fields
	// 	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	// 	curl_setopt($ch, CURLOPT_VERBOSE, true,);
	// 	curl_setopt($ch, CURLOPT_URL, $url);
	// 	$response = curl_exec($ch);
	// 	echo curl_error($ch);
	// 	curl_close($ch);

	// 	$response = json_decode($response, true);
	// 	if ($response["message"] == "username tidak terdaftar") {
	// 		return json_encode($response);
	// 	}else if ($response["message"] == "password salah") {
	// 		return json_encode($response);
	// 		// echo "<script>alert('asd');</script>";
	// 	}else{
	// 		// print_r($response);
	// 	}
	// }

	function session()
	{
		$usercode = $this->input->post("usercode");
		$username = $this->input->post("username");
		$grpcode = $this->input->post("grpcode");
		$status = $this->input->post("status");
		$exp = $this->input->post("exp");

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
