<?php
include 'config.php';

$produk=$_POST['produk'];
$kodeproduk=$_POST['kodeproduk'];
$namaproduk=$_POST['namaproduk'];
$deskripsi=$_POST['deskripsi'];
$harga=$_POST['harga'];
$kategori=$_POST['kategori'];

if ($namaproduk=='' or $kodeproduk=='') {		
    header("Location:index.php?hal=addproduk&status=4");
	exit();	
}

$query="insert into mstproduk (kodeproduk,namaproduk,deskripsi,harga,kategori) values('$kodeproduk','$namaproduk','$deskripsi','$harga','$kategori')";
$sql= mysqli_query($link,$query) or die(mysql_error());
if ($sql) {
	echo "<meta http-equiv='refresh' content='0;url=index.php?hal=listproduk'>";
}
else {
	echo " <meta http-equiv='refresh' content='0;url=index.php?hal=addproduk'>";
}

?>