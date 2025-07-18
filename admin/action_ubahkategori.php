<?php
include 'config.php';

$kategori_id=$_POST['kategori_id'];
$namakategori=$_POST['namakategori'];

$updatefoto1='';

if ($_FILES['nama_file1']['size']>0) {

	$lokasi_file1=$_FILES['nama_file1']['tmp_name'];
	$nama_file1=$_FILES['nama_file1']['name'];
	$tipe_file1=$_FILES['nama_file1']['type'];
	$ukuran_file1=$_FILES['nama_file1']['size'];

	$nama_baru1=preg_replace("/\s+/", "_", $nama_file1);
	$direktori1="../resource/img/kategori/".$nama_baru1;
	$MAX_FILE_SIZE=1000000;

	if(strlen($nama_file1)<1) {
		header("Location:index.php?hal=editkategori&status=1 hal=editkategori&kategori_id=$kategori_id");
		exit();
	}

	$formatgambar1=array("image/jpg","image/jpeg","image/gif","image/png");
	if(!in_array($tipe_file1,$formatgambar1)){
	header("Location:index.php?hal=editkategori&status=2 hal=editkategori&kategori_id=$kategori_id");
	exit();
	}

	if ($ukuran_file1>$MAX_FILE_SIZE) {
		header("Location:index.php?hal=editkategori&status=3 hal=editkategori&kategori_id=$kategori_id");
		exit();	
	}

	move_uploaded_file($lokasi_file1,$direktori1);    
   }
 
if ($_FILES['nama_file1']['size']>0) {
  $query="Update mstkategori set kategori_nama='$namakategori',kategori_gambar='$nama_baru1' where kategori_id='$kategori_id'";
}
else {
  $query="Update mstkategori set kategori_nama='$namakategori' where kategori_id='$kategori_id'";
}
$sql= mysqli_query($link,$query) or die(mysql_error());
if ($sql) {
	echo "<meta http-equiv='refresh' content='1;url=index.php?hal=listkategori'>";	
}
else {
	echo "Edit gagal <meta http-equiv='refresh' content='1;url=index.php?hal=editkategori&kategori_id=$kategori_id'>";
}


?>