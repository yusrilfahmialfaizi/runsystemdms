<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Menu extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		// if ($this->session->userdata('status') != "login") {
		// 	redirect("login");
		// }
		$this->load->view('partials2/main/page2/page_menu');
	}

	public function Add_modul()
	{
		// if ($this->session->userdata('status') != "login") {
		// 	redirect("login");
		// }
		$this->load->view('partials2/main/page2/page_add_modul');
	}

	public function Add_modul_menu()
	{
		// if ($this->session->userdata('status') != "login") {
		// 	redirect("login");
		// }
		$this->load->view('partials2/main/page2/page_add_modul_menu');
	}

	public function Add_group()
	{
		// if ($this->session->userdata('status') != "login") {
		// 	redirect("login");
		// }
		$this->load->view('partials2/main/page2/page_add_group');
	}
	public function Add_group_menu()
	{
		// if ($this->session->userdata('status') != "login") {
		// 	redirect("login");
		// }
		$this->load->view('partials2/main/page2/page_add_group_menu');
	}
}
