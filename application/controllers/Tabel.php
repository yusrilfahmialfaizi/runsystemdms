<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("menu");
		// $this->load->library("multi_menu");
		// $items = $this->menu->getModulMenu();
		// $items = json_decode($items, true);
		// $items = $items['menu'][0]['modulmenu'];
		// $this->multi_menu->set_items($items);
	}
	
	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			// redirect("login");
		}
		$data2 = $this->menu->getModulMenu();
		$data2 = json_decode($data2, true);
		// echo "<pre>"; 
		// print_r($data2['menu'][0]['modulmenu']);
		// echo "</pre>";
		$data["sidebar"] = $data2;
		$data1 = $this->getDataDocuments();
		$data1 = json_decode($data1, true);
		$data["get"] = $data1;

		// $items = $this->menu->getModulMenu();
		// $items = json_decode($items, true);
		// $items = $items['menu'][0]['modulmenu'];
		// $this->multi_menu->set_items($items);
		// echo $this->multi_menu->render('Item-0');

		// $config["nav_tag_open"]          = '<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">';		
		// $config["parent_tag_open"]       = '<li class="dropdown-submenu">';			
		// $config["parent_anchor_tag"]     = '<a tabindex="-1" href="%s">%s</a>';	
		// $config["children_tag_open"]     = '<ul class="dropdown-menu">';			
		// $config["item_divider"]          = "<li class='divider'></li>";

		// $this->multi_menu->initialize($config);
		$this->load->view('partials2/main/page/page_tabel', $data);
	}

	public function getDataDocuments(){
		$url = "http://127.0.0.1:8080/runsystemdms/getDataDocuments";
		// inisiasi curl
		$ch = curl_init();
		// akan mengembalikan nilai respon, jika salah maka respon akan di cetak
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// set url
		curl_setopt($ch, CURLOPT_URL, $url);
		// eksekusi
		$data = curl_exec($ch);
		curl_close($ch);
		return $data;
	}

	
	function GenerateCode(){
		$url = "http://127.0.0.1:8080/runsystemdms/getGenerateCode/".$this->session->userdata("modul");
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$data = curl_exec($ch);
		curl_close($ch);
		
		$data = json_decode($data, true);
		$number = $data["docno"];
		if ($number == null) {
			$number = 1;
		}else{
			$number += 1;
		}
		date_default_timezone_set('Asia/Jakarta');
		$tahun = date("Y");
		$bulan = date("m");
		$modul = $this->session->userdata("modul");
		$batas = str_pad($number, 4, "0", STR_PAD_LEFT);
		$code = $batas."/GSS/INVESTAI/".$modul."/".$bulan."/".$tahun;
		return $code;
	}
	function createDocument(){
		$code = $this->GenerateCode();
		$modulcode = $this->session->userdata("modul");
		$url = "http://127.0.0.1:8080/runsystemdms/postDataDocuments";
		date_default_timezone_set('Asia/Jakarta');
		$now = date('YmdHi');
		$data = array(
			"Docno" =>$code,
			"ModulCode"=>$modulcode, 
			"ActiveInd" => "Y", 
			"Status" => "O",
			"CreateBy" => $this->session->userdata("usercode"),
			"CreateDt" => $now,
			"LastUpBy" => "",
			"LastUpAt" => ""
		);
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data); //pass encoded JSON string to post fields
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($ch, CURLOPT_VERBOSE, true);
		curl_setopt($ch, CURLOPT_URL, $url);
		$response = curl_exec($ch);
		echo curl_error($ch);
		curl_close($ch);
		redirect(base_url("tabel"));
	}

	function modul_session(){
		$modul = $this->input->post("modulCode");
		$this->session->set_userdata(array("modul" => $modul));
	}

	function menu_session(){
		$menu = $this->input->post("menuCode");
		$this->session->set_userdata(array("menu" => $menu));
	}

	function ModulMenuById(){
		$this->load->library("menu");
		$this->load->library("multi_menu");
		$modulcode = $this->input->post('modulCode');
		// echo $modulcode;
		$items = $this->menu->getModulMenuById($modulcode);
		$items = json_decode($items, true);
		$items = $items['menu'];
		$this->multi_menu->set_items($items); 
		echo json_encode($this->multi_menu->render('Item-0')); 
	}

	function doc_session(){
		$docno = $this->input->post("docno");
		$active = $this->input->post("active");
		$this->session->set_userdata(array("docno" => $docno, "active" => $active));
		echo $docno."\n";
		echo $this->session->userdata("docno");
	}
	function update_statushdr(){
		$url = 'http://127.0.0.1:8080/runsystemdms/editDataDocumentshdr';
		$checked = $this->input->post("checked");
		$docno = $this->session->userdata("docno");
		$lastupby = $this->session->userdata("usercode");
		date_default_timezone_set('Asia/Jakarta');
		$lastupdt = date('YmdHi');
		$data = [
			"docno" => $docno,
			"status" => $checked,
			"lastupby" => $lastupby,
			"lastupdt" => $lastupdt
		];
		if ($docno != null) {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
			curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt($ch, CURLOPT_VERBOSE, true);
			curl_setopt($ch, CURLOPT_URL, $url);
			$response = curl_exec($ch);
			echo curl_error($ch);
			curl_close($ch);
		}
	}
}
?>
