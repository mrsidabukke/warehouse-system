<?php

namespace App\Controllers;

use App\Models\ModelUser;

class Home extends BaseController
{
    public function index(): string
    {
        return view('login');
    }


    public function ceklogin()
    {
        $session = session();
        $user = new ModelUser();
        $uname = $this->request->getVar('no_karyawan');
        $pasw = md5($this->request->getVar('password'));
        $ada = $user->where("no_karyawan = '$uname' AND password = '$pasw'")->first();
        if ($ada) {
            $session->set('no_karyawan', $ada['no_karyawan']);
            $session->set('roles', $ada['roles']);
            

            return redirect()->to(base_url('/barang'));
            //echo 'login berhasil';
        } else {
            dd($pasw, $uname);
            $session->setFlashdata(
                'pesan',
                '<div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <h5><i class="icon fas fa-xmark"></i>Opsss, Username/Password Salah</h5>
                </div>'
            );
            return redirect()->to(base_url('.'));
            //echo "gagal";
        }
    }

    public function menu()
    {
        $session = session();
        if ($session->get('no_karyawan') != NULL) {
            return view('template/v_konten');
        } else {
            return redirect()->to(base_url('.'));
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        $session->setFlashdata(
            'pesan',
            '<div class="alert alert-info alert-dismissible">
            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
            <h5><i class="icon fas fa-check"></i>Anda berhasil logout</h5>
            </div>'
        );
        return view('login');
    }
}
