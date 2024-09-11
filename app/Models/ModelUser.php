<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelUser extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'tbl_user';
    protected $primaryKey = 'no_karyawan';
    protected $useAutoIncrement = 'false';
    protected $InsertID = '0';
    protected $returnType = 'array';
    protected $protectFields = 'true';
    protected $allowedFields = [
        'no_karyawan ', 'password',  'roles'
    ];

    //Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdFiled = 'created_ad';
    protected $updateField = 'tgl_update';
    protected $deleteField = 'deleted_at';

    public function getUser()
    {
        return $this->db->table('tbl_user')
            ->select('tbl_user.*,tbl_karyawan.nama')
            ->join('tbl_karyawan', 'tbl_karyawan.nomor_karyawan=tbl_user.no_karyawan')
            ->get()->getResultArray();
    }
}
