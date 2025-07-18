<?php

include 'config.php';

$produk=$_GET['produk'];
$kodegambar=$_GET['kodegambar'];
$nama_file='';
$query="select * from imgproduk where produk='$produk' and kodegambar='$kodegambar'";
$sql= mysqli_query($link,$query) or die(mysql_error());
$data=mysqli_fetch_array($sql);
if ($sql) {
	$nama_file1=$data['gambar'];
}	else {
	echo "<script type='text/javascript'>
	          alert('Gagal Baca Data')
	      </script>
	 <meta http-equiv='refresh' content='1;url=index.php'>";
}

$query="delete from imgproduk where produk='$produk' and kodegambar='$kodegambar'";
$sql= mysqli_query($link,$query) or die(mysql_error());
if ($sql) {
	if (nama_file1<>'') {chmod("../resource/img/product/".$nama_file1, 755);
	unlink("../resource/img/product/".$nama_file1);}

	echo  "<script type='text/javascript'>
	          alert( '$query' )
	      </script>
	 <meta http-equiv='refresh' content='0;url=index.php?hal=gambarproduk&produk=$produk'>";
}
else {
	echo "Delete gagal <meta http-equiv='refresh' content='1;url=index.php?hal=gambarproduk&produk=$produk'>";
}