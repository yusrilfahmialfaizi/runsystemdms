<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("menu");
		$this->load->library("documentdtl");
		$this->load->library("mypdf");
	}
	
	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			redirect("login");
		}
		$data2 = $this->menu->getModulMenu();
		$data2 = json_decode($data2, true);
		$data["sidebar"] = $data2;
		$data1 = $this->getDataDocuments();
		$data1 = json_decode($data1, true);
		$data["get"] = $data1;
		$this->load->view('partials2/main/page/page_tabel', $data);
	}

	function pdf()
  {
	$this->load->view('partials2/main/page/page_pdf');
    $html = $this->output->get_output();
	$this->load->library('mypdf');
	$this->dompdf->loadHtml($html);
	$this->dompdf->setPaper('A4', 'portrait');
	$this->dompdf->render();
	$this->dompdf->stream("a.pdf", array("Attachment"=>0));

	//$this->load->view('partials2/main/page/page_pdf');
	//$this->mypdf->generate('partials2/main/page/page_pdf');
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
		$code = $batas."/GSS/INVESTASI/".$modul."/".$bulan."/".$tahun;
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
		$menuName = $this->input->post("menuName");
		$this->session->set_userdata(array("menu" => $menu, "menuName" => $menuName));
	}

	function ModulMenuById(){
		$this->load->library("menu");
		$this->load->library("multi_menu");
		$modulcode = $this->input->post('modulCode');
		$dt = array("docno" => $this->session->userdata("docno"), "modulcode" => $modulcode);
		$response = $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getDocsDtlForMenu", $dt);
		$response = json_decode($response, true);
		$items = $response["documentsdtl"];
		$this->multi_menu->set_items($items); 
		echo json_encode($this->multi_menu->render('Item-0')); 
	}

	function doc_session(){
		$docno = $this->input->post("docno");
		$active = $this->input->post("active");
		$status = $this->input->post("status");
		$this->session->set_userdata(array(
			"docno" => $docno, 
			"active" => $active, 
			"doc_status" => $status));
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
