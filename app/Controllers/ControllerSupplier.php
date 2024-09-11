<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelSupplier;
use CodeIgniter\HTTP\ResponseInterface;

class ControllerSupplier extends BaseController
{
    public function index()
    {
        $session = session();
        $mhsModel = new ModelSupplier();
        //$prodi = new ModelProdi();
        if ($session->get('no_karyawan') != NULL) {
            $data = [
                'tbl_supplier' => $mhsModel->findAll(),
                //'prodi' => $prodi->getJurusanProdi()
            ];
            return view('supplier/v_supplier', $data);
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
        $nama = $this->request->getVar('nama');
        $no_hp = $this->request->getVar('no_hp');
        $alamat = $this->request->getVar('alamat');
        $data = [
            'nama' => $nama,
            'no_hp' => $no_hp,
            'alamat' => $alamat
          
        ];
        $mhsModel =  new ModelSupplier();

        $ada = $mhsModel->where('id', $id)->first();
        if (!$ada) {
            $mhsModel->insert($data); //simpan data
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-success alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>Sukses
        Simpan Data .</h5>
        </div>'
            );
        } else {
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-xmark"></i>Gagal
        data sudah ada di database.</h5>
        </div>'
            );
        }
        return redirect()->to('supplier');
    }

    public function updatedata()
    {
        $session = session();
        $id = $this->request->getVar('id');
        $nama = $this->request->getVar('nama');
        $no_hp = $this->request->getVar('no_hp');
        $alamat = $this->request->getVar('alamat');

        $data = [
            'id' => $id,
            'nama' => $nama,
            'no_hp' => $no_hp,
            'alamat' => $alamat
          
        ];
     
        $where = [
            'id' => $id
        ];
        $mhsModel = new ModelSupplier();
        $mhsModel->update($where, $data); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Update Data </h5>
                </div>'
        );
        return redirect()->to('supplier');
    }

    public function hapusdata()
    {
        $session = session();
        $mhsModel = new ModelSupplier();
        $where = [
            'id' => $this->request->getVar('id')
        ];
        $mhsModel->delete($where); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Delete hapus data.</h5>
                </div>'
        );
        return redirect()->route('supplier');
    }
}
