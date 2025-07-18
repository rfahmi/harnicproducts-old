<?php
include 'config.php';

$produk=$_POST['produk'];
$kodeproduk=$_POST['kodeproduk'];
$namaproduk=$_POST['namaproduk'];
$deskripsi=$_POST['deskripsi'];
$harga=$_POST['harga'];
$kategori=$_POST['kategori'];

if ($namaproduk=='' or $kodeproduk=='') {		
    header("Location:index.php?hal=editproduk&status=4");
		exit();	
}

$query="Update mstproduk set kodeproduk='$kodeproduk',namaproduk='$namaproduk',deskripsi='$deskripsi',harga='$harga',kategori='$kategori' where produk='$produk'";
$sql= mysqli_query($link,$query) or die(mysql_error());
if ($sql) {
	echo "Edit berhasil <meta http-equiv='refresh' content='1;url=index.php?hal=listproduk'>";	
}
else {
	echo "Edit gagal <meta http-equiv='refresh' content='1;url=editproduk.php?hal=editproduk'>";
}


?>