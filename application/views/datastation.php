<section class="section">
  <div class="row" id="basic-table">
    <div class="col-12 mt-3">
      <?php
        if ($this->session->flashdata('pesan')) {
          echo '<div class="alert alert-success alert-dismissible show fade">';
          echo $this->session->flashdata('pesan');
          echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button></div>';
        }
      ?>
      <a href="<?= base_url('station/input') ?>" class="btn btn-primary mb-3"><b>+</b> Tambah Data</a>
      <div class="card">
        <div class="card-content">
          <!-- Table with no outer spacing -->
          <div class="table-responsive">
            <table class="table mb-0 table-lg">
              <thead>
                <tr>
                  <th>No</th>
                  <th>Nama Station</th>
                  <th>Alamat</th>
				  <th>Latitude</th>
				  <th>Longitude</th>
                  <th>Action</th>
                </tr>
              </thead>
              <tbody>
                <?php $no=1; foreach ($station as $key => $value) { ?>

                <tr>
                  <td><?= $no++; ?></td>
                  <td><?= $value->nama_station; ?></td>
                  <td><?= $value->alamat; ?></td>
				  <td><?= $value->latitude; ?></td>
				  <td><?= $value->longitude; ?></td>
                  <td>
                    <a href="<?= base_url('station/edit/'. $value->id_station) ?>" class="btn btn-info mb-2"><i
                        class="bi bi-pencil-square"></i></a>
                    <a href="<?= base_url('station/hapus/'. $value->id_station) ?>" class="btn btn-danger"
                      onclick="return confirm('Apakah anda yakin ingin menghapus data?')"><i
                        class="bi bi-trash"></i></a>
                  </td>
                </tr>

                <?php } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>