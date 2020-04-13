<?php 
// koneksi database
include '../setting/koneksi.php';
$id_barang = $_GET['id_barang'];

$id = $_GET['id'];
$qty = $_GET['qty_update'];
//cari id_barang di transaksi
$cek2 = mysqli_query($koneksi,"SELECT * from inventory where id_barang ='$id_barang' ");
    $query1   =mysqli_fetch_array($cek2);
    $harga_jual= $query1['harga_jual'];
    $harga_beli = $query1['harga_beli_satuan'];
    $harga_beli_baru = $qty*$harga_beli;
    $harga_baru = $qty*$harga_jual;
    $untung = $harga_baru-$harga_beli_baru;
$update = mysqli_query($koneksi,"update sementara set qty ='$qty',harga ='$harga_baru' ,harga_jual='$harga_beli_baru',untung='$untung' where id_transaksi ='$id'");

if($update){
    //cek saldo 
 $query_saldo = mysqli_query($koneksi,"select *from tbl_saldo");
 $fetch_saldo = mysqli_fetch_array($query_saldo);
 $saldo_awal = $fetch_saldo['total_saldo'];
 $saldo_akhir = $saldo_awal+$harga_baru-$harga_jual;        
 //simpan transaksi di log saldo
  //update saldo baru
  $update_saldo = mysqli_query($koneksi,"update tbl_saldo set total_saldo = '$saldo_akhir' where id_saldo = '1'");
 
    header("location:../pages/forms/transaksi.php");

}else{
    header("location:../pages/forms/transaksi.php?pesan=fail");


}
?>