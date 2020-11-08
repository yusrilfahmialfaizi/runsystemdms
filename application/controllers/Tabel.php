<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tabel extends CI_Controller {

	
	public function index()
	{
		if ($this->session->userdata('status') != "login") {
			redirect("login");
		}
		// $url = "http://127.0.0.1:8080/runsystemdms/getDataDocuments";
		// // inisiasi curl
		// $ch = curl_init();
		// // akan mengembalikan nilai respon, jika salah maka respon akan di cetak
		// curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// // set url
		// curl_setopt($ch, CURLOPT_URL, $url);
		// // eksekusi
		// $data = curl_exec($ch);
		// curl_close($ch);
		$data1 = $this->getDataDocuments();
		$data1 = json_decode($data1, true);
		$data2 = $this->getModulMenu();
		$data2 = json_decode($data2, true);

		// foreach ($data2 as $key) {
		// 	for ($i=0; $i < count($key); $i++) { 
		// 		for ($j=0; $j < count($key[$i]["modul"]); $j++) { 
		// 			echo $key[$i]["modul"][$j]["modulname"];
		// 			for ($k=0; $k < count($key[$i]["modulmenu"]); $k++) { 
		// 				echo "<pre>";
		// 				// print_r($key);
		// 				// print_r($key[$i]["modul"]);
		// 				// print_r($key[$i]["modulmenu"]);
		// 				if ($key[$i]["modul"][$j]["modulcode"] == $key[$i]["modulmenu"][$k]["modulcode"]){
			// 					print_r($key[$i]["modulmenu"][$k]["menudesc"]);
			// 				}
			// 				echo"</pre>";
			// 			}
			// 		}
			// 	}
			// }
			// foreach ($data2 as $key) { 
			// 	for ($i=0; $i < count($key); $i++) { 
			// 		for ($j=0; $j < count($key[$i]["modul"]); $j++) { 
			// 			echo $key[$i]["modul"][$j]["modulname"]; 
			// 			for ($k=0; $k < count($key[$i]["modulmenu"]); $k++) 
			// 			{
			// 				if ($key[$i]["modul"][$j]["modulcode"] == $key[$i]["modulmenu"][$k]["modulcode"])
			// 				{
			// 					echo "<pre>";
			// 					echo $key[$i]["modulmenu"][$k]["menudesc"]."\n\n";
			// 					print_r($key[$i]["modulmenu"][$k]);
			// 					echo "</pre>";
			// 			}
			// 		}
			// 	}
			// }
		// } 
		// print_r($data2["modul"]);
		$data["get"] = $data1;
		$data["sidebar"] = $data2;
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

	public function getModulMenu(){
		$url = "http://127.0.0.1:8080/runsystemdms/getModuls";
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
		$url = "http://127.0.0.1:8080/runsystemdms/getGenerateCode";
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
		$batas = str_pad($number, 4, "0", STR_PAD_LEFT);
		$code = $batas."/GSS/INVESTAI/FICO/".$bulan."/".$tahun;
		return $code;
	}
}
?>
