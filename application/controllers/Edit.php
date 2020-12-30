<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Edit extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("menu");
		$this->load->library("documentdtl");
	}

	public function index()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('privilegecode') != "user" && $this->session->userdata('privilegecode') != "admin") {
			redirect("login");
		}
		$menucode 		= $this->session->userdata("menu");
		$docno 			= $this->session->userdata("docno");
		$doc 			= $this->documentdtl->getDocumentDtl($docno, $menucode);
		$projectcode 		= $this->session->userdata("projectcode");
		$data2 			= $this->menu->getModulById($projectcode);
		$data2 			= json_decode($data2, true);
		$doc 			= json_decode($doc, true);
		$data 			= array(
			'docno' 		=> $docno,
			'projectcode'	=> $projectcode
		);
		$response 		= $this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/getDataDocumentsHdr", $data);
		$response 		= json_decode($response, true);
		$response			= $response['datadocument'][0];
		$data['hdr']		= $response;
		$data["sidebar"] 	= $data2;
		$data["doc"] 		= $doc;
		if ($data2 == null) {
			$this->load->view('partials2/main/page/page_error');
		}else{
			$this->load->view('partials2/main/page/page_edit', $data);
		}
	}

	function EditDocDetail()
	{
		$docno 		= $this->session->userdata("docno");
		$projectcode	= $this->session->userdata("projectcode");
		$menucode 	= $this->session->userdata("menu");
		$description 	= $this->input->post("deskripsi");
		$stts 		= $this->input->post("chk-ani");
		if ($stts == "on") {
			$status = "F";
		} else {
			$status = "O";
		}
		$lastupby = $this->session->userdata("usercode");
		date_default_timezone_set('Asia/Jakarta');
		$lastupdt = date('YmdHi');
		$doc = $this->documentdtl->getDocumentDtl($docno, $menucode);
		$doc = json_decode($doc, true);
		if ($doc['documentsdtl'] != null) {
			$data = array(
				"docno" 		=> $docno,
				"projectcode" 	=> $projectcode,
				"menucode" 	=> $menucode,
				"description" 	=> $description,
				"status" 		=> $status,
				"lastupby" 	=> $lastupby,
				"lastupdt" 	=> $lastupdt
			);
			# update
			$response = $this->documentdtl->callApiDocDtl('PUT', "http://127.0.0.1:8080/runsystemdms/editDataDocuments", $data);
			if ($response) {
				$this->session->set_flashdata('alert', '<div class="alert alert-primary dark alert-dismissible fade show" role="alert">
					<p><strong>Data telah tersimpan</strong></p>
			        <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					</div>');
				$data1 = [
					"docno" 		=> $docno,
					"lastupby"	=> $lastupby,
					"lastupdt" 	=> $lastupdt
				];
				$this->documentdtl->callApiDocDtl("POST", "http://127.0.0.1:8080/runsystemdms/postLog", $data1);
			} else {
				$this->session->set_flashdata('alert', '<div class="alert alert-primary dark alert-dismissible fade show" role="alert">
					<p><strong>Data belum tersimpan</strong></p>
			        <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
					</div>');
			}
			redirect(base_url("edit"));
		}
	}
}
