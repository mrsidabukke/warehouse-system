<?php

namespace App\Controllers;

use App\Models\ModelBarang;
use App\Models\ModelBarangMasuk;
use App\Controllers\BaseController;
use App\Models\ModelTransaksi;
use CodeIgniter\HTTP\ResponseInterface;

class DashboardController extends BaseController
{
    public function index()
    {
      

        $barangModel = new ModelBarang();
        $barangMasukModel = new ModelBarangMasuk();
        $transaksiModel = new ModelTransaksi();

        $data = [
            'allItems' => $barangModel->findAll(),
            'lowStockItems' => $barangModel->where('stok <', 10)->findAll(),
            'outOfStockItems' => $barangModel->where('stok', 0)->findAll(),
            'barang' => $barangModel->findAll(),
            'barang_masuk' => $barangMasukModel->getBarangMasukd(),
            'transaksi' => $transaksiModel->getTransaksid()
        ];
        return view('dashboard/v_dashboard', $data);
    }
}
