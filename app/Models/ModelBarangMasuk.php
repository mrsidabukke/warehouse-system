<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelBarangMasuk extends Model
{
    protected $table            = 'barang_masuk';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['id_brg','tanggal','stok'];

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

    public function getBarangMasuk()
    {
        return $this->db->table('barang_masuk')
            ->select('barang_masuk.*,tbl_barang.nama_barang,')
            ->join('tbl_barang', 'tbl_barang.id=barang_masuk.id_brg')
       
            ->get()->getResultArray();
    }

    public function getBarangMasukd()
{
    return $this->db->table('barang_masuk')
        ->select('barang_masuk.*, tbl_barang.nama_barang')
        ->join('tbl_barang', 'tbl_barang.id = barang_masuk.id_brg')
        ->get()->getResultArray();
}

}


