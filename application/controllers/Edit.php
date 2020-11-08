<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("menu");
	}

	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			redirect("login");
		}
		$data2 = $this->menu->getModulMenu();
		$data2 = json_decode($data2, true);
		$data["sidebar"] = $data2;
        	$this->load->view('partials2/main/page/page_edit', $data);
	}

	
	
}
?>