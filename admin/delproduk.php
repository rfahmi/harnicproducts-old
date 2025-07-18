<?php

include 'config.php';

$produk=$_GET['produk'];
$query="select * from imgproduk where produk='$produk'";
$sql= mysqli_query($link,$query) or die(mysql_error());
while ($data=mysqli_fetch_array($sql)):
		$kodegambar=$data['kodegambar'];
		$nama_file1=$data['gambar'];
		if (nama_file1<>'') {chmod("../resource/img/product/".$nama_file1, 755);
		unlink("../resource/img/product/".$nama_file1);}

		$query="delete from imgproduk where produk='$produk' and kodegambar='$kodegambar'";
		$sql= mysqli_query($link,$query) or die(mysql_error());
		if ($sql) {}
		else {}
endwhile;	

$query="delete from mstproduk where produk='$produk'";
$sql= mysqli_query($link,$query) or die(mysql_error());
if ($sql) {
	echo "<script type='text/javascript'>
	          alert('Product Deleted')
	      </script>
	 <meta http-equiv='refresh' content='0;url=index.php?hal=listproduk'>";
}
else {
	echo "failed to delete <meta http-equiv='refresh' content='1;url=index.php?hal=listproduk'>";
}