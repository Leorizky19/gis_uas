<section id="basic-horizontal-layouts">
  <div class="row match-height">
    <div class="col-md-5 col-12">
      <div class="card mt-3">
        <div class="card-content">
          <div class="card-body">
            <?php 
              if (isset($error_upload)) {
                echo '<div class="alert alert-danger alert-dismissible show fade"><button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>'. $error_upload .'</div>';
              }
              echo form_open_multipart('station/edit/'.$station->id_station);
            ?>
            <div class="form-body">
              <div class="row">
                <div class="col-md-4">
                  <label>Nama Station</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" value="<?= $station->nama_station ?>" required class="form-control"
                    name="nama_station" placeholder="Nama Station">
                </div>


                <div class="col-md-4">
                  <label>Alamat</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="text" value="<?= $station->alamat ?>" required class="form-control" name="alamat"
                    placeholder="Alamat">
                </div>

              

                <div class="col-md-4">
                  <label>Latitude</label>
                </div>
                <div class="col-md-8 form-group d-flex align-items-center">
                  <input class="form-check-input w-20 me-2" type="checkbox" id="CheckLat">
                  <input type="text w-80" id="Latitude" value="<?= $station->latitude ?>" class="form-control"
                    name="latitude" placeholder="Latitude">
                </div>

                <div class="col-md-4">
                  <label>Longitude</label>
                </div>
                <div class="col-md-8 form-group d-flex align-items-center">
                  <input class="form-check-input w-20 me-2" type="checkbox" id="CheckLong">
                  <input type="text w-80 " id="Longitude" value="<?= $station->longitude ?>" class="form-control"
                    name="longitude" placeholder="Longitude">
                </div>

                <div class="col-md-4">
                  <label>Gambar</label>
                </div>
                <div class="col-md-8 form-group d-flex align-items-center">
                  <img src="<?= base_url('gambar/'. $station->gambar) ?>" class="rounded" width="100%">
                </div>
                <div class="col-md-4">
                  <label>Ganti Gambar</label>
                </div>
                <div class="col-md-8 form-group">
                  <input type="file" class="form-control" name="gambar">
                </div>

                <div class="col-sm-12 d-flex mt-5">
                  <button type="submit" class="w-50 btn btn-primary me-1 mb-1">Edit</button>
                  <button type="reset" class="w-50 btn btn-light-secondary me-1 mb-1">Reset</button>
                </div>

              </div>
            </div>
            <?php echo form_close();?>
          </div>
        </div>
      </div>
    </div>
    <div class="col-md-7 col-12">
      <div class="card mt-3">
        <div class="card-content">
          <div class="card-body">
            <form class="form form-horizontal">
              <div class="form-body">
                <div class="row">
                  <div id="mapid" style="height: 400px;"></div>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>


<script>
var curLocation = [0, 0];
if (curLocation[0] == 0 && curLocation[1] == 0) {
  curLocation = [<?= $wisata->latitude ?>, <?= $wisata->longitude ?>];
}

var mymap = L.map('mapid').setView([<?= $wisata->latitude ?>, <?= $wisata->longitude ?>], 14);
L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
  subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
}).addTo(mymap);

mymap.attributionControl.setPrefix(false);
var marker = new L.marker(curLocation, {
  draggable: 'true'
});

marker.on('dragend', function(event) {
  var position = marker.getLatLng();
  marker.setLatLng(position, {
    draggable: 'true'
  }).bindPopup(position).update();
  $("#Latitude").val(position.lat);
  $("#Longitude").val(position.lng).keyup();
});

$("#Latitude, #Longitude").change(function() {
  var position = [parseInt($("#Latitude").val()), parseInt($("#Longitude").val())];
  marker.setLatLng(position, {
    draggable: 'true'
  }).bindPopup(position).update();
  mymap.panTo(position);
});
mymap.addLayer(marker);

$(document).ready(function() {
  $('#Latitude').prop('readOnly', true);
  $('#Longitude').prop('readOnly', true);

  $('#CheckLat').on('click', function() {
    if ($(this).prop('checked')) {
      $('#Latitude').prop('readOnly', false);
    } else {
      $('#Latitude').prop('readOnly', true);
    }
  });
  $('#CheckLong').on('click', function() {
    if ($(this).prop('checked')) {
      $('#Longitude').prop('readOnly', false);
    } else {
      $('#Longitude').prop('readOnly', true);
    }
  });
});
</script>