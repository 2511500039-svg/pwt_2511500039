<?php
$totalPasien = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM pasien"));
$totalAhli = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM ahli_gizi"));
$totalKonsultasi = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM konsultasi"));
$totalProgram = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) AS total FROM program_diet"));
$pasienCount = (int) ($totalPasien['total'] ?? 0);
$ahliCount = (int) ($totalAhli['total'] ?? 0);
$konsultasiCount = (int) ($totalKonsultasi['total'] ?? 0);
$programCount = (int) ($totalProgram['total'] ?? 0);
?>
<div class="row">
  <div class="col-lg-3 col-6"><div class="small-box bg-info"><div class="inner"><h3><?= $pasienCount; ?></h3><p>Total Pasien</p></div><div class="icon"><i class="fas fa-users"></i></div></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-success"><div class="inner"><h3><?= $ahliCount; ?></h3><p>Total Ahli Gizi</p></div><div class="icon"><i class="fas fa-user-md"></i></div></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-primary"><div class="inner"><h3><?= $konsultasiCount; ?></h3><p>Total Konsultasi</p></div><div class="icon"><i class="fas fa-stethoscope"></i></div></div></div>
  <div class="col-lg-3 col-6"><div class="small-box bg-warning"><div class="inner"><h3><?= $programCount; ?></h3><p>Total Program Diet</p></div><div class="icon"><i class="fas fa-apple-alt"></i></div></div></div>
</div>
<div class="row"><div class="col-lg-12"><div class="card"><div class="card-header"><h3 class="card-title">Ringkasan Data Klinik</h3></div><div class="card-body"><canvas id="dashboardChart" style="min-height:250px;"></canvas></div></div></div></div>
<script src="plugins/chart.js/Chart.min.js"></script>
<script>
var ctx = document.getElementById('dashboardChart').getContext('2d');
new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Pasien', 'Ahli Gizi', 'Konsultasi', 'Program Diet'],
        datasets: [{ label: 'Total Data', backgroundColor: ['#007bff','#28a745','#17a2b8','#ffc107'], borderColor: ['#0056b3','#1e7e34','#117a8b','#d39e00'], borderWidth:1, data: [<?= $pasienCount; ?>, <?= $ahliCount; ?>, <?= $konsultasiCount; ?>, <?= $programCount; ?>] }]
    },
    options: { responsive:true, maintainAspectRatio:false, scales:{ y:{ beginAtZero:true } } }
});
</script>
