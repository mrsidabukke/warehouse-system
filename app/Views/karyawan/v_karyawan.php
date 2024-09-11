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
          <h1>DATA KARYAWAN</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item"><a href="#">Master</a></li>
            <li class="breadcrumb-item active">KARYAWAN</li>
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
              <?php if($userrole == '2'){ ?>
              <button class="btn btn-primary" data-toggle="modal" data-target="#tambah">
                <i class="fa fa-plus"></i>Tambah</button>
              <?php } ?>
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
                    <th width="5%">NO </th>
                    <th width="10%">NOMOR KARYAWAN</th>
                    <th>NAMA KARYAWAN </th>
                    <th>UMUR </th>
                    <th>ALAMAT </th>
                    

                  </tr>
                </thead>

                <tbody>
                  <?php foreach ($tbl_karyawan as $index => $kry) { ?>
                    <tr>
                      <td><?= $index + 1 ?> </td>
                      <td> <?= $kry['nomor_karyawan'] ?> </td>
                      <td> <?= $kry['nama'] ?> </td>
                      <td> <?= $kry['umur'] ?> </td>
                      <td> <?= $kry['alamat'] ?> </td>
                    
                 
                      <?php if($userrole == '2'){ ?>
                      <td class="text-center">
                        <button type="buttton" class="btn btn-sm btn-warning edit-data" data-toggle="modal" data-target="#edit" data-nomor_karyawan="<?= $kry['nomor_karyawan'] ?>" data-nama="<?= $kry['nama'] ?>
                        " data-umur="<?= $kry['umur'] ?>" data-alamat="<?= $kry['alamat'] ?>" > <i class="fa fa-edit"></i></button>

                        <button type="button" class="btn btn-sm btn-danger hapus-data" data-toggle="modal" data-target="#hapus" data-nomor_karyawan="<?= $kry['nomor_karyawan'] ?>">
                          <i class="fa fa-trash"></i></button>

                      </td>
                      <?php } ?>
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
      <form action="<?= base_url() ?>karyawan/simpandata" method="post">
        <div class="modal-body">
          <p>Silahkan Tambahkan Data</p>
          <div class="form-group">
            <label for="exampleInputEmail1">nomor karyawan</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="nomor_karyawan" placeholder="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">nama karyawan</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="nama" placeholder="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">umur</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="umur" placeholder="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">alamat</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="alamat" placeholder="">
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
        <h4 class="modal-title">edit data</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="<?= base_url() ?>karyawan/updatedata" method="post">
          <p>Yakin Data Mau di Edit?</p>
          <div class="form-group">

            <input type="hidden" id="nomor_karyawan" name="nomor_karyawan">

            <label for="exampleInputEmail1">nama karyawan</label>
            <input type="text" readonly class="form-control" id="nama" name="nama" placeholder="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">umur</label>
            <input type="text" class="form-control" id="umur" name="umur" placeholder="">
          </div>

          <div class="form-group">
            <label for="exampleInputEmail1">alamat</label>
            <input type="text" class="form-control" id="alamat" name="alamat" placeholder="">
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
      <form action="<?= base_url() ?>karyawan/hapusdata" method="post">
        <div class="modal-body">
          <p id="pesan">Yakin Data karyawan Mau di Hapus?</p>
          <div class="form-group">
            <input type="hidden" id="nomor_karyawan" name="nomor_karyawan">
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
      var nomor_karyawan = $(this).data('nomor_karyawan');
      var nama = $(this).data('nama');
      var umur = $(this).data('umur');
      var alamat = $(this).data('alamat');
     
      $(".modal-body #nomor_karyawan").val(nomor_karyawan);
      $(".modal-body #nama").val(nama);
      $(".modal-body #umur").val(umur);
      $(".modal-body #alamat").val(alamat);
      
    });

    $(document).on("click", ".hapus-data", function() {
      var nomor_karyawan = $(this).data('nomor_karyawan');
      $(".modal-body #nomor_karyawan").val(nomor_karyawan);
      $(".modal-body #pesan").html("<code>Yakin data akan di hapus dengan nomor karyawan:" + nomor_karyawan + "??</code");
    });
  });
</script>

<?= $this->endSection() ?>