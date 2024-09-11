<?= $this->extend('template/template') ?>
<?= $this->section('konten') ?>
<?php $userrole = session()->get('roles'); ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DASHBOARD</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active">DASHBOARD</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <section class="content">
    <div class="container mt-5">
      <?php if($userrole == '2'){ ?>
        <!-- Stock Levels Chart Card -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Chart Stok Barang</h5>
              </div>
              <div class="card-body">
                <canvas id="stockChart"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Barang Masuk Chart Card -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Chart Barang Masuk</h5>
              </div>
              <div class="card-body">
                <canvas id="chartBarangMasuk" width="800" height="400"></canvas>
              </div>
            </div>
          </div>
        </div>

        <!-- Barang Keluar Chart Card -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card">
              <div class="card-header">
                <h5 class="card-title">Chart Barang Keluar</h5>
              </div>
              <div class="card-body">
                <canvas id="chartBarangKeluar" width="800" height="400"></canvas>
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <!-- Low Stock Items Table Card -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card mb-4">
              <div class="card-header">
                <h5 class="card-title">Low Stock Items</h5>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama Barang</th>
                      <th>Stok</th>
                      <th>Harga</th>
                      <th>Tanggal Exp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($lowStockItems as $item): ?>
                    <tr>
                      <td><?= $item['id'] ?></td>
                      <td><?= $item['nama_barang'] ?></td>
                      <td><?= $item['stok'] ?></td>
                      <td><?= $item['harga'] ?></td>
                      <td><?= $item['tgl_exp'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>

        <!-- Out of Stock Items Table Card -->
        <div class="row">
          <div class="col-md-12 mb-3">
            <div class="card mb-4">
              <div class="card-header">
                <h5 class="card-title">Out of Stock Items</h5>
              </div>
              <div class="card-body">
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Nama Barang</th>
                      <th>Stok</th>
                      <th>Harga</th>
                      <th>Tanggal Exp</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php foreach ($outOfStockItems as $item): ?>
                    <tr>
                      <td><?= $item['id'] ?></td>
                      <td><?= $item['nama_barang'] ?></td>
                      <td><?= $item['stok'] ?></td>
                      <td><?= $item['harga'] ?></td>
                      <td><?= $item['tgl_exp'] ?></td>
                    </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
     
    </div>
  </section>
</div>

<!-- Chart.js Scripts -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('stockChart').getContext('2d');
    var stockChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: <?= json_encode(array_column($barang, 'nama_barang')) ?>,
            datasets: [{
                label: 'Stock Levels',
                data: <?= json_encode(array_column($barang, 'stok')) ?>,
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                borderColor: 'rgba(54, 162, 235, 1)',
                borderWidth: 1
            }]
        },
        options: {
            scales: {
                x: {
                    beginAtZero: true,
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    }
                },
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    document.addEventListener("DOMContentLoaded", function() {
        var dataBarangMasuk = <?= json_encode($barang_masuk) ?>;
        var labelsMasuk = [];
        var stokBarangMasuk = [];
        dataBarangMasuk.forEach(function(item) {
            labelsMasuk.push(item.nama_barang);
            stokBarangMasuk.push(item.stok);
        });
        var ctxMasuk = document.getElementById('chartBarangMasuk').getContext('2d');
        new Chart(ctxMasuk, {
            type: 'line',
            data: {
                labels: labelsMasuk,
                datasets: [{
                    label: 'Barang Masuk',
                    data: stokBarangMasuk,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        var dataTransaksi = <?= json_encode($transaksi) ?>;
        var labelsKeluar = [];
        var jumlahBarangKeluar = [];
        dataTransaksi.forEach(function(item) {
            labelsKeluar.push(item.nama_barang);
            jumlahBarangKeluar.push(item.jumlah);
        });
        var ctxKeluar = document.getElementById('chartBarangKeluar').getContext('2d');
        new Chart(ctxKeluar, {
            type: 'line',
            data: {
                labels: labelsKeluar,
                datasets: [{
                    label: 'Barang Keluar',
                    data: jumlahBarangKeluar,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    x: {
                        beginAtZero: true,
                        ticks: {
                            autoSkip: false,
                            maxRotation: 0,
                            minRotation: 0
                        }
                    },
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    });
</script>

<?= $this->endSection() ?>
