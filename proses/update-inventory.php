<?php
// koneksi database
include '../setting/koneksi.php';
// menangkap data yang di kirim dari form
date_default_timezone_set("Asia/Jakarta");
$timestamps = date("Y-m-d H:i:s");
$id_barang = $_POST['id_barang'];
$nm_barang = $_POST['nm_barang'];
$qty = $_POST['qty'];
$harga_beli = $_POST['harga_beli'];
//$harga_beli_satuan = $harga_beli / $qty;
$harga_jual = $_POST['harga_jual'];
$expired = $_POST['exp'];
$keterangan = $_POST['ket'];

$upstok1= mysqli_query($koneksi, "UPDATE inventory SET nm_barang='$nm_barang',qty='$qty',harga_jual='$harga_jual', harga_beli='$harga_beli',
expired = '$expired',ket='$keterangan',last_upt='$timestamps' WHERE id_barang='$id_barang'"); 
if($upstok1){
    header("location:../pages/tables/inventory.php");

}else{
    header("location:../");

}          

?>