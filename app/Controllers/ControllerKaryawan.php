<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\ModelKaryawan;
use App\Models\ModelUser;
use CodeIgniter\HTTP\ResponseInterface;

class ControllerKaryawan extends BaseController
{

    public function profile()
    {
        $session = session();
        $mhsModel = new ModelUser();
       $userrole = session()->get('roles');

       return $userrole;
        
    }
    public function index()
    {
        $session = session();
        $mhsModel = new ModelKaryawan();
        //$prodi = new ModelProdi();
        if ($session->get('no_karyawan') != NULL) {
            $data = [
                'tbl_karyawan' => $mhsModel->findAll(),
                //'prodi' => $prodi->getJurusanProdi()
            ];
            return view('karyawan/v_karyawan', $data);
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
        $nomor_karyawan = $this->request->getVar('nomor_karyawan');
        $nama = $this->request->getVar('nama');
        $umur = $this->request->getVar('umur');
        $alamat = $this->request->getVar('alamat');
    
        $data = [
            'nomor_karyawan' => $nomor_karyawan,
            'nama' => $nama,
            'umur' => $umur,
            'alamat' => $alamat,
           
        ];
        $mhsModel =  new ModelKaryawan();

        $ada = $mhsModel->where('nomor_karyawan', $nomor_karyawan)->first();
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
        Nomor karyawan sudah ada di database.</h5>
        </div>'
            );
        }
        return redirect()->to('karyawan');
    }

    public function updatedata()
    {
        $session = session();
        $nomor_karyawan = $this->request->getVar('nomor_karyawan');
        $nama = $this->request->getVar('nama');
        $umur = $this->request->getVar('umur');
        $alamat = $this->request->getVar('alamat');
        
        $data = [
            'nomor_karyawan' => $nomor_karyawan,
            'nama' => $nama,
            'umur' => $umur,
            'alamat' => $alamat,
        
        ];
     
        $where = [
            'nomor_karyawan' => $nomor_karyawan
        ];
        $mhsModel = new ModelKaryawan();
        $mhsModel->update($where, $data); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Update Data </h5>
                </div>'
        );
        return redirect()->to('karyawan');
    }

    public function hapusdata()
    {
        $session = session();
        $mhsModel = new ModelKaryawan();
        $where = [
            'nomor_karyawan' => $this->request->getVar('nomor_karyawan')
        ];
        $mhsModel->delete($where); //update data
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-success alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5?><i class="icon fas fa-check"></i>Sukses, 
                Delete Data Karyawan</h5>
                </div>'
        );
        return redirect()->route('karyawan');
    }
}
