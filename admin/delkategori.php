<?php

include 'config.php';

$kategori_id=$_GET['kategori_id'];
$nama_file='';
$query="select a.*,ifnull((select count(1) from mstproduk where kategori=a.kategori_id),0)terpakai from mstkategori a where kategori_id='$kategori_id'";
$sql= mysqli_query($link,$query) or die(mysql_error());
$data=mysqli_fetch_array($sql);
if ($sql) {
	$nama_file=$data['kategori_gambar'];
	$terpakai=$data['terpakai'];
	if ($terpakai>0) {
		echo "<script type='text/javascript'>
	          alert('Tidak dapat dihapus.. kategori ini sudah digunakan pada master produk')
	      </script>
	 <meta http-equiv='refresh' content='0;url=index.php?hal=listkategori'>";

		exit();	
	}
	
}	else {
	echo "<script type='text/javascript'>
	          alert('Gagal Baca Data')
	      </script>
	 <meta http-equiv='refresh' content='1;url=index.php?hal=listkategori'>";
}

$query="delete from mstkategori where kategori_id='$kategori_id'";
$sql= mysqli_query($link,$query) or die(mysql_error());
if ($sql) {
	chmod("../resource/img/product/".$nama_file, 755);
	unlink("../resource/img/product/".$nama_file);

	echo "<script type='text/javascript'>
	          alert('Delete berhasil')
	      </script>
	 <meta http-equiv='refresh' content='0;url=index.php?hal=listkategori'>";
}
else {
	echo "Delete gagal <meta http-equiv='refresh' content='1;url=index.php?hal=listkategori'>";
}