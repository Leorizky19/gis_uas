<?php

class Home extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_station');
  }

  public function index()
  {
    $data = array(
      'title' => 'Charging Station',
      'station' => $this->m_station->tampil(),
      'isi' => 'pemetaan'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

}

/* End of file Controllername.php */