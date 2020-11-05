<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {

	
	public function index()
	{
		// if ($this->session->userdata('status') != "login") {
		// 	redirect("login");
		// }
		$url = "http://127.0.0.1:8080/runsystemdms/getDataDocuments";
		$data = file_get_contents($url);
		$data = json_decode($data, true);
		$data["post"] = $data; 
		// foreach ($data as $key) {
		// 	# code...
		// 	for ($i=0; $i < count($key); $i++) { 
		// 		# code...
		// 		echo "<pre>";
		// 		print_r($key[$i]["docno"]);
		// 		echo "</pre>";
		// 	}
		// }
		// print_r(json_decode($data.["datadocument"]));
		// print_r(json_decode($data['datadocument']));
		$this->load->view('partials2/main/page/page_tabel', $data);
	}
}
?>
