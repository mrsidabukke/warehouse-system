<?= $this->extend('template/template') ?>
<?= $this->section('konten') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>FORM TRANSAKSI</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active">TRANSAKSI</li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
        <div class="col-12">
          <!-- Default box -->
          <div class="card">
            <div class="card-header">
              <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                <i class="fa fa-plus"></i>BUAT TRANSAKSI</button>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <?php if ((session()->getFlashdata('pesan') !== NULL)) {
                echo session()->getFlashData('pesan');
              } ?>
              <table class="table" >
                <thead>
                  <tr>
                  
                    <th width="10%">ID </th>
                    <th>TANGGAL TRANSAKSI </th>
                    <th>NAMA BARANG </th>
                    <th>JUMLAH </th>
                    <th>NAMA KARYAWAN </th>
                    

                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($tbl_transaksi as $index => $tsi) { ?>
                    <tr>
                   
                      <td> <?= $tsi['id'] ?> </td>
                      <td> <?= $tsi['tgl_transaksi'] ?> </td>
                      <td> <?= $tsi['nama_barang'] ?> </td>
                      <td> <?= $tsi['jumlah'] ?> </td>
                      <td> <?= $tsi['nama'] ?> </td>
                   
                  

                        <!-- <button type="button" class="btn btn-sm btn-danger hapus-data" data-toggle="modal" data-target="#hapus" data-id="<?= $tsi['id'] ?>">
                          <i class="fa fa-trash"></i></button> -->
                      </td>
                    </tr>

                  <?php } ?>
                </tbody>
              </table>
            </div>
            <!-- /.card-body -->

          </div>
          <!-- /.card -->
        </div>
      </div>
    </div>
  </section>
  <!-- /.content -->
</div>

<!-- /.content-wrapper -->
                  
<!--MOdal Tambah-->
<div class="modal fade" id="tambah">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h4 class="modal-title">tambah Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url() ?> transaksi/simpandata" method="post">
        <div class="modal-body">
          <p>Silahkan isi data transaksi disini</p>
          <div class="form-group">
            <label for="exampleInputEmail1">tanggal transaksi</label>
            <input type="date" class="form-control" id="exampleInputEmail1" name="tgl_transaksi" placeholder="">
          </div>

          <div class="form-group">
            <label for="id_barang">barang</label>
            <select name="id_barang" id="id_barang" class="form-control">
              <option value="..::PILIH::.."></option>
              <?php foreach ($tbl_barang as $prd) { ?>
                <option value="<?= $prd['id'] ?>"> <?= $prd['nama_barang'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">jumlah</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="jumlah" placeholder="">
          </div>

          <div class="form-group">
            <label for="id_karyawan">karyawan</label>
            <select name="id_karyawan" id="id_karyawan" class="form-control">
              <option value="..::PILIH::.."></option>
              <?php foreach ($tbl_karyawan as $prd) { ?>
                <option value="<?= $prd['nomor_karyawan'] ?>"> <?= $prd['nama'] ?></option>
              <?php } ?>
            </select>
          </div>

       

          <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-light"> <i class="fa fa-save"></i>Save</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!-- 
          <div class="form-group">
            <label for="jenkel">Jenis Kelamin</label>
            <select name="jk" class="form-control">
              <option value="L">Laki-Laki</option>
              <option value="P">Perempuan</option>
            </select>
          </div> -->

   
  <!-- /.modal-content -->

  <!-- /.modal-dialog -->
</div>

<!--Modal Edit-->



<!--Modal Hapus-->
<div class="modal fade" id="hapus">
  <div class="modal-dialog">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h4 class="modal-title">Info Modal</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="<?= base_url() ?> transaksi/hapusdata" method="post">
        <div class="modal-body">
          <p id="pesan">Yakin Data Transaksi Mau di Hapus?</p>
          <div class="form-group">
            <input type="hidden" id="id" name="id">
          </div>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-light"> <i class="fa fa-save"></i>Delete</button>
        </div>
      </form>
    </div>
    <!-- /.modal-content -->
  </div>
  <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?= $this->endSection() ?>

<?= $this->section("script") ?>
<script>
  $(document).ready(function() {

   

    $(document).on("click", ".hapus-data", function() {
      var id = $(this).data('id');
      $(".modal-body #id").val(id);
      $(".modal-body #pesan").html("<code>Yakin data akan di hapus dengan id:" + id + "??</code");
    });
  });
</script>

<?= $this->endSection() ?>