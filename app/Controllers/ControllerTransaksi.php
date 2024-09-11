<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelBarang;
use App\Models\ModelKaryawan;

class ControllerTransaksi extends BaseController
{
    public function index()
    {
        $session = session();
        $mhsModel = new ModelTransaksi();
        $brgmodel = new ModelBarang();
        $karmodel = new ModelKaryawan();
        //$prodi = new ModelProdi();
        if ($session->get('no_karyawan') != NULL) {
            $data = [
                'tbl_transaksi' => $mhsModel->getTransaksi(),
                'tbl_barang' => $brgmodel->findAll(),
                'tbl_karyawan' => $karmodel->findAll(),
                //'prodi' => $prodi->getJurusanProdi()
            ];
            return view('transaksi/v_transaksi', $data);
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
        $tgl_transaksi = $this->request->getVar('tgl_transaksi');
        $id_barang = $this->request->getVar('id_barang');
        $jumlah = $this->request->getVar('jumlah');
        $id_karyawan = $this->request->getVar('id_karyawan');
       
        $data = [
            'tgl_transaksi' => $tgl_transaksi,
            'id_barang' => $id_barang,
            'jumlah' => $jumlah,
            'id_karyawan' => $id_karyawan
        ];
        $mhsModel =  new ModelTransaksi();
        $brgmodel = new ModelBarang();
        $ada = $brgmodel->where('id', $id_barang)->first();
        if (!$ada) {
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>transaksi gagal</h5>
        </div>'
            );
        } 
        $mhsModel->insert($data); //simpan data
        $brgmodel->update($id_barang, ['stok' => $ada['stok'] - $jumlah]);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-succes alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-xmark"></i>transaksi sukes</h5>
        </div>'
            );
            return redirect()->to('transaksi');
        }
      
    


    public function hapusdata()
    {
        $session = session();
        $mhsModel = new ModelTransaksi();
        $where = [
            'id' => $this->request->getVar('id')
        ];
        $mhsModel->delete($where); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Delete Data Transaksi.</h5>
                </div>'
        );
        return redirect()->route('transaksi');
    }
}
