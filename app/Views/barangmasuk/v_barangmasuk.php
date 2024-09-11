<?= $this->extend('template/template') ?>
<?= $this->section('konten') ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>DATA BARANG Masuk</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active">BARANG</li>
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
                <i class="fa fa-plus"></i>Tambah</button>

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
                    <th>NAMA BARANG </th>
                    <th>TANGGAL </th>
              
                    <th>JUMLAH BARANG YANG MASUK</th>
                    

                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($barang_masuk as $index => $brg) { ?>
                    <tr>
                   
                      <td> <?= $brg['id'] ?> </td>
                      <td> <?= $brg['nama_barang'] ?> </td>
                      <td> <?= $brg['tanggal'] ?> </td>
                     
                      <td> <?= $brg['stok'] ?> </td>
                      <td class="text-center">
                        <button type="buttton" class="btn btn-sm btn-warning edit-data" data-toggle="modal" data-target="#edit" data-id="<?= $brg['id'] ?>" data-id_brg="<?= $brg['id_brg'] ?>
                        " data-tanggal="<?= $brg['tanggal'] ?>" data-stok="<?= $brg['stok'] ?> "> <i class="fa fa-edit"></i></button>
<!-- 
                        <button type="button" class="btn btn-sm btn-danger hapus-data" data-toggle="modal" data-target="#hapus" data-id="<?= $brg['id'] ?>">
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
      <form action="<?= base_url() ?>barangmasuk/simpandata" method="post">
        <div class="modal-body">
          <p>Silahkan Tambahkan Data</p>

        <div class="form-group">
            <label for="id_brg">barang</label>
            <select name="id_brg" id="id_brg" class="form-control">
              <option value="..::PILIH::.."></option>
              <?php foreach ($allbrg as $prd) { ?>
                <option value="<?= $prd['id'] ?>"> <?= $prd['nama_barang'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">tanggal</label>
            <input type="date" class="form-control" id="exampleInputEmail1" name="tanggal" placeholder="">
          </div>

 
          
          <div class="form-group">
            <label for="exampleInputEmail1">stok</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="stok" placeholder="">
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
<div class="modal fade" id="edit">
  <div class="modal-dialog modal-lg">
    <div class="modal-content bg-dark">
      <div class="modal-header">
        <h4 class="modal-title">edit barang</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url() ?>barangmasuk/updatedata" method="post">
          <p>Yakin Data Barang Mau di Hapus?</p>
          <div class="form-group">
            <label for="id_brg">barang</label>
            <select name="id_brg" id="id_brg" class="form-control">
              <option value="..::PILIH::.."></option>
              <?php foreach ($allbrg as $prd) { ?>
                <option value="<?= $prd['id'] ?>"> <?= $prd['nama_barang'] ?></option>
              <?php } ?>
            </select>
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">tanggal</label>
            <input type="date" class="form-control" id="stok" name="tanggal" placeholder="">
          </div>

          
          <div class="form-group">
            <label for="exampleInputEmail1">stok</label>
            <input type="text" class="form-control" id="harga" name="stok" placeholder="">
          </div>
 

        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-warning"> <i class="fa fa-save"></i>Update</button>
        </form>

        </div>

    </div>

  </div>
    

    <!-- /.modal-content -->
  </div>
  
  <!-- /.modal-dialog -->
</div>


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
      <form action="<?= base_url() ?>barangmasuk/hapusdata" method="post">
        <div class="modal-body">
          <p id="pesan">Yakin Data Barang Mau di Hapus?</p>
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

    $(document).on("click", ".edit-data", function() {
      var id = $(this).data('id');
      var id_brg = $(this).data('id_brg');
      var tanggal = $(this).data('tanggal');
     
      var stok = $(this).data('stok');
      $(".modal-body #id").val(id);
      $(".modal-body #id_brg").val(id_brg);
      $(".modal-body #tanggal").val(tanggal);
  
      $(".modal-body #id_supp").val(stok);
    });

    $(document).on("click", ".hapus-data", function() {
      var id = $(this).data('id');
      $(".modal-body #id").val(id);
      $(".modal-body #pesan").html("<code>Yakin data akan di hapus dengan id:" + id + "??</code");
    });
  });
</script>

<?= $this->endSection() ?>