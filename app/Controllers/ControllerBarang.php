<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBarang;
use App\Models\ModelSupplier;
use App\Models\ModelJenis;
use CodeIgniter\HTTP\ResponseInterface;

class ControllerBarang extends BaseController
{
    public function index()
    {
        $session = session();
        $mhsModel = new ModelBarang();
        $suppmodel = new ModelSupplier();
        $jnsmodel = new ModelJenis();
        if ($session->get('no_karyawan') != NULL) {
            $data = [
                'tbl_barang' => $mhsModel->getBarang(),
                'alljns' => $jnsmodel->findAll(),
                'allsupp' => $suppmodel->findAll(),
            ];
            return view('barang/v_barang', $data);
        } else {
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-"></i>Silahkan login terlebih dahulu</h5>
        </div>'
            );
            return redirect()->to(base_url('.'));
        }
    }

    public function simpandata()
    {
        $session = session();
        $id = $this->request->getVar('id');
        $nama = $this->request->getVar('nama_barang');
        $stok = $this->request->getVar('stok');
        $harga = $this->request->getVar('harga');
        $tgl_exp = $this->request->getVar('tgl_exp');
        $id_supplier = $this->request->getVar('id_supplier');
        $id_jenis = $this->request->getVar('id_jenis');
       // $kd = explode('-',  $this->request->getVar('prodi'));
        $data = [
            'nama_barang' => $nama,
            'stok' => $stok,
            'harga' => $harga,
            'tgl_exp' => $tgl_exp,
            'id_supplier' => $id_supplier,
            'id_jenis' => $id_jenis
        ];
        $mhsModel =  new ModelBarang();
        $suppmodel = new ModelSupplier();
        $jnsmodel = new ModelJenis();

        $ada = $mhsModel->where('id', $id)->first();
        if (!$ada) {
            $mhsModel->insert($data); //simpan data
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>Sukses
        Simpan Data Barang.</h5>
        </div>'
            );
        } else {
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-xmark"></i>Gagal
        Nim Mahasiswa sudah ada di database.</h5>
        </div>'
            );
        }
        return redirect()->to('barang');
    }

    public function updatedata()
    {
        $session = session();
        $id = $this->request->getVar('id');
        $nama = $this->request->getVar('nama_barang');
        $stok = $this->request->getVar('stok');
        $harga = $this->request->getVar('harga');
        $tgl_exp = $this->request->getVar('tgl_exp');
        $id_supplier = $this->request->getVar('id_supplier');
        $id_jenis = $this->request->getVar('id_jenis');
        $data = [
            'id' => $id,
            'nama_barang' => $nama,
            'stok' => $stok,
            'harga' => $harga,
            'tgl_exp' => $tgl_exp,
            'id_supplier' => $id_supplier,
            'id_jenis' => $id_jenis
        ];
     
        $where = [
            'id' => $id
        ];
        $mhsModel = new ModelBarang();
        $mhsModel->update($where, $data); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Update Data Barang.</h5>
                </div>'
        );
        return redirect()->to('barang');
    }

    public function hapusdata()
    {
        $session = session();
        $mhsModel = new ModelBarang();
        $where = [
            'id' => $this->request->getVar('id')
        ];
        $mhsModel->delete($where); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Delete Data Barang.</h5>
                </div>'
        );
        return redirect()->route('barang');
    }
}
