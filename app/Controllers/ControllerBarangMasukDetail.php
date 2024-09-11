<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\ModelBarangMasuk;
use App\Models\ModelBarang;
use App\Models\ModelSupplier;
use App\Models\ModelBarangMasukDetail;

class ControllerBarangMasukDetail extends BaseController
{
    public function index()
    {
        $session = session();
        $mhsModel = new ModelBarangMasukDetail();


    
        if ($session->get('no_karyawan') != NULL) {
            $data = [
                'barang_masuk_detail' => $mhsModel->findAll(),
            ];
           
            return view('barangmasukdetail/v_barangmasukdetail', $data);
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
        
        $tanggal = $this->request->getVar('tanggal');
       
       // $kd = explode('-',  $this->request->getVar('prodi'));
        $data = [
        
            'tanggal' => $tanggal,
          
        ];
        $mhsModel =  new ModelBarangMasukDetail();

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
        return redirect()->to('barangmasukdetail');
    }

    public function updatedata()
    {
        $session = session();
        $id = $this->request->getVar('id');
      
        $tanggal = $this->request->getVar('tanggal');
       
        $data = [
            'id' => $id,
            
            'tanggal' => $tanggal,
            
        ];
     
        $where = [
            'id' => $id
        ];
        $mhsModel = new ModelBarangMasukDetail();
        $mhsModel->update($where, $data); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Update Data Barang.</h5>
                </div>'
        );
        return redirect()->to('barangmasukdetail');
    }

    public function hapusdata()
    {
        $session = session();
        $mhsModel = new ModelBarangMasukDetail();
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
        return redirect()->route('barangmasukdetail');
    }

    public function showmasuk()
    {
        
    }
}
