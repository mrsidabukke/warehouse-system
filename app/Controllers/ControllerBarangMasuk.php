<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelBarang;
use App\Models\ModelBarangMasuk;
use App\Models\ModelSupplier;
use CodeIgniter\HTTP\ResponseInterface;

class ControllerBarangMasuk extends BaseController
{
    public function index()
    {
        $session = session();
        $mhsModel = new ModelBarangMasuk();
        $brgmodel = new ModelBarang();
        $suppmodel = new ModelSupplier();

    
        if ($session->get('no_karyawan') != NULL) {
            $data = [
                'barang_masuk' => $mhsModel->getBarangMasuk(),
                'allbrg' => $brgmodel->findAll(),
                'allsupp' => $suppmodel->findAll(),

            ];
           
            return view('barangmasuk/v_barangmasuk', $data);
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
        $id_brg = $this->request->getVar('id_brg');
        $tanggal = $this->request->getVar('tanggal');
      
        $stok = $this->request->getVar('stok');
 
        $data = [
            'id_brg' => $id_brg,
            'tanggal' => $tanggal,
         
            'stok' => $stok,
            
        ];
        $mhsModel =  new ModelBarangMasuk();
        $brgmodel = new ModelBarang();
        $ada = $brgmodel->where('id', $id_brg)->first();
        if (!$ada) {
          $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>dang adong barangna.</h5>
        </div>'

            );
            return redirect()->to('barangmasuk');
        } 
         $mhsModel->insert($data); //simpan data
         $brgmodel->update($id_brg, ['stok' => $ada['stok'] + $stok]);
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i>Sukses
    Simpan Data Barang Masuk.</h5>
    </div>'
        );
        return redirect()->to('barangmasuk');
    }

    public function updatedata()
    {
        $session = session();
        $id = $this->request->getVar('id');
        $id_brg = $this->request->getVar('id_brg');
        $tanggal = $this->request->getVar('tanggal');
    
        $stok = $this->request->getVar('stok');
        $data = [
            'id' => $id,
            'id_brg' => $id_brg,
            'tanggal' => $tanggal,
        
            'stok' => $stok,
        ];
     
        $where = [
            'id' => $id
        ];
        $mhsModel = new ModelBarangMasuk();
        $mhsModel->update($where, $data); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Update Data Barang Masuk.</h5>
                </div>'
        );
        return redirect()->to('barangmasuk');
    }

    public function hapusdata()
    {
        $session = session();
        $mhsModel = new ModelBarangMasuk();
        $where = [
            'id' => $this->request->getVar('id')
        ];
        $mhsModel->delete($where); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Delete Data Barang Masuk.</h5>
                </div>'
        );
        return redirect()->route('barangmasuk');
    }
}
