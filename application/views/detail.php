<div id="mapid" style="height: 100vh; z-index: 0;"></div>

<script>
var mymap = L.map('mapid').setView([<?= $station->latitude ?>, <?= $station->longitude ?>], 20);

L.tileLayer('http://{s}.google.com/vt/lyrs=s,h&x={x}&y={y}&z={z}', {
  subdomains: ['mt0', 'mt1', 'mt2', 'mt3']
}).addTo(mymap);

var redIcon = new L.Icon({
  iconUrl: 'https://raw.githubusercontent.com/pointhi/leaflet-color-markers/master/img/marker-icon-2x-red.png',
  shadowUrl: 'https://cdnjs.cloudflare.com/ajax/libs/leaflet/0.7.7/images/marker-shadow.png',
  iconSize: [25, 41],
  iconAnchor: [12, 41],
  popupAnchor: [1, -34],
  shadowSize: [41, 41]
});

L.marker([<?= $station->latitude ?>, <?= $station->longitude ?>], {
  icon: redIcon
}).addTo(mymap).bindPopup(
  "<img class='mb-2' src='<?= base_url('gambar/'.$station->gambar) ?>' width='100%'>" +
  "<b><?= $station->nama_station ?></b><br />" +
  "<?= $station->alamat ?><br />", {
    minWidth: 300
  }
).openPopup();
</script>