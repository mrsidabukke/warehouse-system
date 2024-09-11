<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelTransaksi extends Model
{
    protected $table            = 'tbl_transaksi';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = ['tgl_transaksi','id_barang','jumlah','id_karyawan'];

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

    public function getTransaksi()
    {
        return $this->db->table('tbl_transaksi')
            ->select('tbl_transaksi.*,tbl_barang.nama_barang, tbl_karyawan.nama ')
            ->join('tbl_barang', 'tbl_barang.id=tbl_transaksi.id_barang')
            ->join('tbl_karyawan', 'tbl_karyawan.nomor_karyawan=tbl_transaksi.id_karyawan')
            ->get()->getResultArray();
    }

    public function getTransaksid()
{
    return $this->db->table('tbl_transaksi')
        ->select('tbl_transaksi.*, tbl_barang.nama_barang')
        ->join('tbl_barang', 'tbl_barang.id = tbl_transaksi.id_barang')
        ->get()->getResultArray();
}

}
