<?php

class M_station extends CI_Model {

  public function simpan($data)
  {
    $this->db->insert('lokasi', $data);
    
  }

  public function tampil()
  {
    $this->db->select('*');
    $this->db->from('lokasi');
    $this->db->order_by('id_station', 'desc');
    return $this->db->get()->result();
  }

  public function detail($id_station)
  {
    $this->db->select('*');
    $this->db->from('lokasi');
    $this->db->where('id_station', $id_station);
    return $this->db->get()->row();
  }

  public function edit($data)
  {
    $this->db->where('id_station', $data['id_station']);
    $this->db->update('lokasi', $data);
  }

  public function hapus($data)
  {
    $this->db->where('id_station', $data['id_station']);
    $this->db->delete('lokasi', $data);
  }
}

/* End of file ModelName.php */