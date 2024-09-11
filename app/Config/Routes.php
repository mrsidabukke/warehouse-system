<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->post('/ceklogin', 'Home::ceklogin');
$routes->get('/menu', 'Home::menu');
$routes->get('/logout', 'Home::logout');


$routes->get('/', 'Home::index');

//barang
$routes->get('/barang', 'ControllerBarang::index');
$routes->post('/barang/simpandata', 'ControllerBarang::simpandata');
$routes->post('/barang/updatedata', 'ControllerBarang::updatedata');
$routes->post('/barang/hapusdata', 'ControllerBarang::hapusdata');

//supplier
$routes->get('/supplier', 'ControllerSupplier::index');
$routes->post('/supplier/simpandata', 'ControllerSupplier::simpandata');
$routes->post('/supplier/updatedata', 'ControllerSupplier::updatedata');
$routes->post('/supplier/hapusdata', 'ControllerSupplier::hapusdata');

//karyawan
$routes->get('/karyawan', 'ControllerKaryawan::index');
$routes->post('/karyawan/simpandata', 'ControllerKaryawan::simpandata');
$routes->post('/karyawan/updatedata', 'ControllerKaryawan::updatedata');
$routes->post('/karyawan/hapusdata', 'ControllerKaryawan::hapusdata');

//transaksi
$routes->get('/transaksi', 'ControllerTransaksi::index');
$routes->post('/transaksi/simpandata', 'ControllerTransaksi::simpandata');
$routes->post('/transaksi/hapusdata', 'ControllerTransaksi::hapusdata');

// barang masuk
$routes->get('/barangmasuk', 'ControllerBarangMasuk::index');
$routes->post('/barangmasuk/simpandata', 'ControllerBarangMasuk::simpandata');
$routes->post('/barangmasuk/updatedata', 'ControllerBarangMasuk::updatedata');
$routes->post('/barangmasuk/hapusdata', 'ControllerBarangMasuk::hapusdata');

//barang masuk detail
$routes->get('/barangmasukdetail', 'ControllerBarangMasukDetail::index');
$routes->post('/barangmasukdetail/simpandata', 'ControllerBarangMasukDetail::simpandata');
$routes->post('/barangmasukdetail/updatedata', 'ControllerBarangMasukDetail::updatedata');
$routes->post('/barangmasukdetail/hapusdata', 'ControllerBarangMasukDetail::hapusdata');

//barang keluar detail
$routes->get('/barangkeluardetail', 'ControllerBarangKeluarDetail::index');
$routes->post('/barangkeluardetail/simpandata', 'ControllerBarangKeluarDetail::simpandata');
$routes->post('/barangkeluardetail/updatedata', 'ControllerBarangKeluarDetail::updatedata');
$routes->post('/barangkeluardetail/hapusdata', 'ControllerBarangKeluarDetail::hapusdata');

//dashboard
$routes->get('/dashboard', 'DashboardController::index');
$routes->get('/dashboard', 'Dashboard::index');

