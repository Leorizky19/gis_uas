<?php

class Station extends CI_Controller {

  
  public function __construct()
  {
    parent::__construct();
    $this->load->model('m_station');
  }
  

  public function index()
  {
    $data = array(
      'title' => 'List Charging Station',
      'station' => $this->m_station->tampil(),
      'isi' => 'datastation'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  public function input()
  { 
    $this->form_validation->set_rules('nama_station', 'Nama Station', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('latitude', 'Latitude', 'required');
    $this->form_validation->set_rules('longitude', 'Longitude', 'required');
    
    if ($this->form_validation->run() == TRUE) {
      $config['upload_path']          = './gambar/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 2000;
      $this->upload->initialize($config);

      if (! $this->upload->do_upload('gambar')) {
        $data = array(
          'title' => 'Input Charging Station',
          'error_upload' => $this->upload->display_errors(),
          'isi' => 'input_datastation'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $config['image_library'] = 'gd2';
        $config['source_image'] = './gambar'.$upload_data['uploads']['file_name'];
        $this->load->library('image_lib', $config);
        $data = array(
          'nama_station' => $this->input->post('nama_station'),
          'alamat' => $this->input->post('alamat'),
          'latitude' => $this->input->post('latitude'),
          'longitude' => $this->input->post('longitude'),
          'gambar' => $upload_data['uploads']['file_name']
        );
        $this->m_station->simpan($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Disimpan');
        
        redirect('station/input');
      }
    }

    $data = array(
      'title' => 'Input Charging Station',
      'isi' => 'input_datastation'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  public function edit($id_station)
  {
    $this->form_validation->set_rules('nama_station', 'Nama Station', 'required');
    $this->form_validation->set_rules('alamat', 'Alamat', 'required');
    $this->form_validation->set_rules('latitude', 'Latitude', 'required');
    $this->form_validation->set_rules('longitude', 'Longitude', 'required');

    if ($this->form_validation->run() == TRUE) {
      $config['upload_path']          = './gambar/';
      $config['allowed_types']        = 'gif|jpg|png|jpeg';
      $config['max_size']             = 2000;
      $this->upload->initialize($config);

      if (! $this->upload->do_upload('gambar')) {
        $data = array(
          'title' => 'Edit Charging Station',
          'error_upload' => $this->upload->display_errors(),
          'station' => $this->m_station->detail($id_station),
          'isi' => 'edit_datastation'
        );
        $this->load->view('layout/wrapper', $data, FALSE);
      } else {
        $upload_data = array('uploads' => $this->upload->data());
        $config['image_library'] = 'gd2';
        $config['source_image'] = './gambar'.$upload_data['uploads']['file_name'];
        $this->load->library('image_lib', $config);
        $data = array(
          'id_station' => $id_station,
          'nama_station' => $this->input->post('nama_station'),
          'alamat' => $this->input->post('alamat'),
          'latitude' => $this->input->post('latitude'),
          'longitude' => $this->input->post('longitude'),
          'gambar' => $upload_data['uploads']['file_name']
        );
        $this->m_station->edit($data);
        $this->session->set_flashdata('pesan', 'Data Berhasil Diedit');
        
        redirect('station');
      }

      $data = array(
        'id_station' => $id_station,
        'nama_station' => $this->input->post('nama_station'),
        'alamat' => $this->input->post('alamat'),
        'latitude' => $this->input->post('latitude'),
        'longitude' => $this->input->post('longitude'),
      );
      $this->m_station->edit($data);
      $this->session->set_flashdata('pesan', 'Data Berhasil Diedit');
      
      redirect('station');
    }

    $data = array(
      'title' => 'Edit Charging Station',
      'station' => $this->m_station->detail($id_station),
      'isi' => 'edit_datastation'
    );
    $this->load->view('layout/wrapper', $data, FALSE);
  }

  public function hapus($id_station)
  {
    $data = array('id_station' => $id_station);
    $this->m_station->hapus($data);
    $this->session->set_flashdata('pesan', 'Data Berhasil Dihapus');
    redirect('station');
  }

  public function detail($id_station)
  {
    $data = array(
      'title' => 'Pemetaan Charging Station',
      'station' => $this->m_station->detail($id_station),
      'isi' => 'detail'
    );
    $this->load->view('details/wrapper', $data, FALSE);
  }
}

/* End of file Controllername.php */