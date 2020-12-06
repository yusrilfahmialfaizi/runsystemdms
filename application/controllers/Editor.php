<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Editor extends CI_Controller
{

	public function __construct()
	{
		parent::__construct();
		$this->load->library("menu");
		$this->load->library("documentdtl");
	}

	public function index()
	{
		if ($this->session->userdata('status') != "login" || $this->session->userdata('grpcode') != "Adm") {
			redirect("login");
		}
		$menucode = $this->session->userdata("menu");
		$docno = $this->session->userdata("docno");
		$doc = $this->documentdtl->getDocumentDtl($docno, $menucode);
		$projectcode = $this->session->userdata("projectcode");
		$data2 = $this->menu->getModulById($projectcode);
		$data2 = json_decode($data2, true);
		$doc = json_decode($doc, true);
		$data["sidebar"] = $data2;
		$data["doc"] = $doc;
		if ($data2 == null) {
			$this->load->view('partials2/main/page/page_error');
		}else{
			$this->load->view('partials2/main/page/page_editor', $data);
		}
	}

	function EditDocDetail()
	{
		$docno = $this->session->userdata("docno");
		$menucode = $this->session->userdata("menu");
		$description = $this->input->post("deskripsi");
		$stts = $this->input->post("chk-ani");
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
				"docno" => $docno,
				"menucode" => $menucode,
				"description" => $description,
				"status" => $status,
				"lastupby" => $lastupby,
				"lastupdt" => $lastupdt
			);
			# update
			$response = $this->documentdtl->callApiDocDtl('PUT', "http://127.0.0.1:8080/runsystemdms/editDataDocuments", $data);
			$this->session->set_flashdata('alert', '<div class="alert alert-primary dark alert-dismissible fade show" role="alert">
					<p><strong>Data telah tersimpan</strong></p>
                    <button class="close" type="button" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
                    </div>');
			redirect(base_url("editor"));
		}
	}
}
