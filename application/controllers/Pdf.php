<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pdf extends CI_Controller {

  public function index()
  {
    $this->load->library('mypdf');
    $this->mypdf->generate('partials2/main/page/page_pdf');
    //$this->load->view('partials2/main/page/page_pdf');
  }

}

