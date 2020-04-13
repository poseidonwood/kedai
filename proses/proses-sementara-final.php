<?php
include '../setting/koneksi.php';


$nm_pembeli = $_POST['nm_pembeli1'];

$update = mysqli_query($koneksi,"update sementara set nm_pembeli ='$nm_pembeli' where keterangan ='SEMENTARA'");
if($update){
    $update1 = mysqli_query($koneksi,"update sementara set keterangan ='DATA TER-ACC' where keterangan ='SEMENTARA'");
    $simpan = mysqli_query($koneksi,"INSERT INTO transaksi (timestamps,id_transaksi,tanggal,jenis_transaksi,nm_pembeli,id_barang,nm_barang,qty,harga,harga_jual,untung,keterangan) SELECT *FROM sementara WHERE keterangan ='DATA TER-ACC'");

    if($simpan){
         
       


    $upstok= mysqli_query($koneksi, "UPDATE inventory SET qty='$sisa',last_upt='$timestamps' WHERE id_barang='$nm_barang'");                
    
    //cek stok apabila stok = 0 , ganti keterangan stok habis
    $data_qty = mysqli_query($koneksi,"select * from inventory where id_barang='$nm_barang'");
    $sto1    =mysqli_fetch_array($data_qty);
    $stok1 = $sto1['qty'];
    if($stok1==0){
        $upstok1= mysqli_query($koneksi, "UPDATE inventory SET KET='HABIS' WHERE id_barang='$nm_barang'");                
        header("location:../pages/forms/keluar.php?pesan=success");

    }elseif($stok1<=5){
        $upstok1= mysqli_query($koneksi, "UPDATE inventory SET KET='MAU HABIS' WHERE id_barang='$nm_barang'");                
        header("location:../pages/forms/keluar.php?pesan=success");
   }else{
    $upstok1= mysqli_query($koneksi, "UPDATE inventory SET KET='AMAN' WHERE id_barang='$nm_barang'");                
    // mengalihkan halaman kembali ke keluar.php
    //hapus table sementara
    $hapus = mysqli_query($koneksi,"delete from sementara where keterangan ='DATA TER-ACC'");
    header("location:../pages/forms/keluar.php?pesan=success");
   }
    }else{
        header("location:../pages/forms/keluar.php?pesan=fail");
    
    
    }
}




    //header("location:../pages/forms/transaksi.php");
}else{
	header("location:../pages/forms/transaksi.php?pesan=unknown");
}



?>