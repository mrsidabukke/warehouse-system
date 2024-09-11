<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelSupplier extends Model
{
    protected $table            = 'tbl_supplier';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['nama','no_hp','alamat'];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];

    // public function getJurusanProdi()
    // {
    //     return $this->db->table('tprodi')
    //         ->select('tprodi.*', 'tjurusan.nama_jurusan')
    //         ->join('tjurusan', 'tjurusan.id=tprodi.id_jurusan')
    //         ->get()->getResultArray();
    // }

    public function getSupplierJenis()
    {
        return $this->db->table('tbl_supplier')
        ->select('tbl_supplier.*', 'tbl_jenis.kategori')
        ->join('tbl_jenis', 'tbl_jenis.id=tbl_supplier.id')
        ->get()->getResultArray();
    }
}
