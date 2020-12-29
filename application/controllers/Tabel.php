<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->library("menu");
		$this->load->library("documentdtl");
		$this->load->library("api");
	}
	
	public function index()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "user" && $this->session->userdata('privilegecode') != "admin") {
			redirect("login");
		}
		$projectcode = $this->session->userdata("projectcode");
		$data2 = $this->menu->getModulById($projectcode);
		$data2 = json_decode($data2, true);
		$data["sidebar"] = $data2;
		if ($data2['modul'] != null) {
			foreach ($data2 as $key) {
				for ($i=0; $i < count($key); $i++) { 
					if ($i == 0) {
						$modul = $key[$i]['modulcode'];
						$this->session->set_userdata(array("modul" => $modul ));
					}
				}
			}
			$sesi = $this->session->userdata('modul');
			$modulcode = $this->input->get("modulcode");
			if ($modulcode != null) {
				$this->modul_sessionForIndex($modulcode);
				$dt		= array("modulcode" => $modulcode, 'projectcode' => $projectcode);
				$response	= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getDataDocuments", $dt);
				$data1 = json_decode($response, true);
				if ($data1 != null) {
					$data["get"] = $data1;
				}else{
					$data["get"] = [];
				}
			}else if ($sesi != null){
				$this->modul_sessionForIndex($sesi);
				$dt		= array("modulcode" => $sesi, 'projectcode' => $projectcode);
				$response	= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getDataDocuments", $dt);
				$data1 	= json_decode($response, true);
				if ($data1 != null) {
					$data["get"] = $data1;
				}else{
					$data["get"] = [];
				}
			}else{
				$data["get"] = [];
			}
			$this->load->view('partials2/main/page/page_tabel', $data);
		}else{
			$this->load->view('partials2/main/page/page_error');
		}
	}
	
	
	function fpdf_output(){
		$docno 		=  $this->input->get("docno");
		$modulcode 	= $this->input->get("modulcode");
		$dt 			= array("docno" => $docno, "modulcode" => $modulcode);
		$response 	= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getDocsDtlForPrint", $dt);
		$response 	= json_decode($response, true);
		$data	= $response['documentsdtl'];
		require(APPPATH . '/third_party/tcpdf/tcpdf.php');
		error_reporting(0);
		$pdf = new TCPDF();
		$pdf->SetProtection(array('copy'), '', null, 0, null);
		$pdf->SetMargins(40, 40, 30, true);
		$pdf->AddPage('P', 'cm', 'A4');
		$pdf->SetPrintHeader(false);
		$pdf->SetPrintFooter(false);
		$pdf->SetAutoPageBreak(true, 15);
		$pdf->SetFont('Times', 'B', 16);
		$pdf->Cell(0,0.5,'DOCUMENT MANAGEMENT SYSTEM',0,1,'C');
		$pdf->Ln();
		foreach ($data as $key ) {
			$pdf->SetFont('Times','B',14);
			$pdf->Cell(1,15, str_replace("0", ".",intVal($key['menucode']))." ".$key['menudesc'],0,1,'L');
			$pdf->SetFont('Times','',12);
			$pdf->WriteHTMLCell(0,0,'','',$key['description']);
			$pdf->Ln();
		}
		$pdf->output();
	}

	public function getDataDocuments($modulcode){
		$url = "http://127.0.0.1:8080/runsystemdms/getDataDocuments/".$modulcode;
		$data = $this->api->get($url);
		return $data;
	}

	
	function GenerateCode(){
		// $modulcode 	= $this->session->userdata("modulcode");
		// $projectcode 	= $this->session->userdata("projectcode");
		// $dt			= array("modulcode" => $modulcode, 'projectcode' => $projectcode);
		// $data 		= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getGenerateCode", $dt);
		$url = "http://127.0.0.1:8080/runsystemdms/getGenerateCode/".$this->session->userdata("modul");
		$data 	= $this->api->get($url);
		
		$data 	= json_decode($data, true);
		$number = $data["docno"]["Int64"];
		if ($number == null) {
			$number = 1;
		}else{
			$number += 1;
		}
		date_default_timezone_set('Asia/Jakarta');
		$tahun 	= date("Y");
		$bulan 	= date("m");
		$modul 	= $this->session->userdata("modul");
		$batas 	= str_pad($number, 4, "0", STR_PAD_LEFT);
		$code	= $batas."/GSS/INVESTASI/".$modul."/".$bulan."/".$tahun;
		echo $code;
		return $code;
	}
	function createDocument(){
		$code 		= $this->GenerateCode();
		$modulcode 	= $this->session->userdata("modul");
		$projectcode 	= $this->session->userdata("projectcode");
		date_default_timezone_set('Asia/Jakarta');
		$now 		= date('YmdHi');
		$data 		= array("modulcode" => $modulcode, 'projectcode' => $projectcode);
		$data1 		= array(
			"Docno" 		=>$code,
			"ModulCode"	=>$modulcode, 
			"ProjectCode"	=>$projectcode, 
			"ActiveInd" 	=> "Y", 
			"Status" 		=> "O",
			"CreateBy" 	=> $this->session->userdata("usercode"),
			"CreateDt" 	=> $now,
			"LastUpBy" 	=> "",
			"LastUpAt" 	=> ""
		);
		$response = $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/editActiveInd", $data);
		$response1 = $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postDataDocuments", $data1);
		// if ($response1) {
			# code...
			// $data2 		= array('modulcode' => $modulcode);
			// $response2 	= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getDataMenuCode", $data2);
			// if ($response2 != null) {
			// 	$response2 = json_decode($response2, true);
			// 	$response2 = $response2['add'];
			// 	foreach ($response2 as $key) {
					
			// 		$data3 		= array(
			// 			"Docno" 		=> $code,
			// 			"MenuCode"	=> $key["menucode"], 
			// 			"CreateBy" 	=> $this->session->userdata("usercode"),
			// 			"CreateDt" 	=> $now,
			// 			"LastUpBy" 	=> "",
			// 			"LastUpAt" 	=> ""
			// 		);
			// 		$response3 	= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postDataDocumentsDtl", $data3);
			// 	}
			// }
		// }
	}

	function modul_session(){
		$modul = $this->input->post("modulCode");
		$this->session->set_userdata(array("modul" => $modul));
	}

	function modul_sessionForIndex($modulcode){
		$this->session->set_userdata(array("modul" => $modulcode));
	}

	function menu_session(){
		$menu 	= $this->input->post("menuCode");
		$menuName = $this->input->post("menuName");
		$this->session->set_userdata(array("menu" => $menu, "menuName" => $menuName));
	}

	function ModulMenuById(){
		$this->load->library("menu");
		$this->load->library("multi_menu");
		$docno 		= $this->input->post('docno');
		$modulcode 	= $this->input->post('modulCode');
		if ($docno != null) {
			$dt = array("docno" => $docno, "modulcode" => $modulcode);
		}else{
			$dt = array("docno" => $this->session->userdata("docno"), "modulcode" => $modulcode);
		}
		$response 	= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getDocsDtlForMenu", $dt);
		$response 	= json_decode($response, true);
		$grpcode		= $this->session->userdata("grpcode");
		$url2 		= "http://127.0.0.1:8080/runsystemdms/getGroupMenuWithId/" . $grpcode;
		$response2	= $this->api->get($url2);
		$data3		= json_decode($response2, true);
		$items 		= $response["documentsdtl"];
		$group 		= $data3["groupmenu"];
		$this->multi_menu->set_items($items, $group); 
		echo json_encode($this->multi_menu->render('Item-0')); 
	}

	function doc_session(){
		$docno 	= $this->input->post("docno");
		$active 	= $this->input->post("active");
		$status 	= $this->input->post("status");
		$this->session->set_userdata(array(
			"docno" 		=> $docno, 
			"active" 		=> $active, 
			"doc_status" 	=> $status));
		echo $this->session->userdata("doc_status");
	}
	function update_statushdr(){
		$url 		= 'http://127.0.0.1:8080/runsystemdms/editDataDocumentshdr';
		$checked 		= $this->input->post("checked");
		$docno 		= $this->session->userdata("docno");
		$projectcode	= $this->session->userdata("projectcode");
		$lastupby 	= $this->session->userdata("usercode");
		date_default_timezone_set('Asia/Jakarta');
		$lastupdt 	= date('YmdHi');
		$data 		= [
			"docno" 		=> $docno,
			"projectcode"	=> $projectcode,
			"status" 		=> $checked,
			"lastupby"	=> $lastupby,
			"lastupdt" 	=> $lastupdt
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
			$this->session->set_userdata(array(
			"doc_status" => $checked));
		}
	}
	function doc_status()
	{	
		$docno 		= $this->input->post('docno');
		$data 		= array(
			'docno' 	=> $docno, 
			'grpcode'	=> $this->session->userdata("grpcode")
		);
		$response 	= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getDocsDtlById", $data);
		$response 	= json_decode($response, true);
		$response 	= $response['documentsdtl'];
		// echo "<pre>";
		// print_r($data);
		// print_r($response);
		if(!in_array("O",array_column($response,'status'))) {
			$response = array('message' => true);
			echo json_encode($response);
		} else {
			$response = array('message' => false);
			echo json_encode($response);
		}
		// echo "</pre>";
	}
	function dochdr()
	{
		$docno 		= $this->input->post('docno');
		$projectcode	= $this->session->userdata("projectcode");

		$data 		= array(
			'docno' 		=> $docno,
			'projectcode'	=> $projectcode
		);
		$response 	= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getDataDocumentsHdr", $data);
		$response 	= json_decode($response, true);
		$response		= $response['datadocument'][0];
		$data 		= array ('status' => $response['status']);
		echo json_encode($data);
		
	}
}
?>
