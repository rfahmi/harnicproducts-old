	<?php
	include 'config.php';

	$kategori_id=$_GET['kategori_id'];

	$query="select a.kategori_id,a.kategori_nama,ifnull(c.kategori_id,b.kategori_id)parent_id,ifnull(c.kategori_nama,b.kategori_nama) Category,case when c.kategori_nama is null then a.kategori_nama else b.kategori_nama end SubCategory,case when c.kategori_nama is null then '' else a.kategori_nama end SubSubCategory,a.kategori_gambar from mstkategori a left join mstkategori b on a.kategori_parent=b.kategori_id left join mstkategori c on b.kategori_parent=c.kategori_id where a.kategori_id not in(select kategori_parent from mstkategori) and a.kategori_id='$kategori_id'";
	$sql= mysqli_query($link,$query) or die(mysql_error());
	$data=mysqli_fetch_array($sql);
	if ($sql) {
		$grandparent=$data['Category'];
		$namasubkategori=$data['SubCategory'];
		$namakategori=$data['kategori_nama'];
		$parentid=$data['parent_id'];
		$nama_file=$data['kategori_gambar'];
	}
    ?>
	<div class="container">
		<h3>Edit Category</h3>
		<hr>
		<div class="row">
			<div class="col-md-6">
				<?php
				if(isset($_GET['status'])):?>

					<div class="alert alert-danger">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<strong>Warning</strong> 					
						<?php
	//					if(isset($_GET['status'])){
							$status=$_GET['status'];
							switch($status){
								case 0:
									echo "Upload berhasil !!";
									break;
								case 1:
									ECHO"BELUM PILIH FILE UPLOAD !";
									break;
								case 2:
									ECHO "upload GAGAL, format yg boleh JPG,PNG dan GIF";
									break;
								case 3:
									echo "upload GAGAL, ukuran fil terlalu besar ";
									break;

							}
						?>
					</div>
				<?php endif?>
				<form action="action_ubahkategori.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label><?php echo $grandparent?></label>						
						<label> ==> <?php echo $namasubkategori?></label>						
						<label> ==> <?php echo $namakategori?></label>						
						<input type="hidden" name="kategori_id" value="<?php echo $kategori_id?>">
						<input type="text" name="namakategori" class="form-control" placeholder="isi nama kategori" value="<?php echo $namakategori;?>">
					</div>

					<div class="form-group">					
						<img src='../resource/img/kategori/<?php echo $data['kategori_gambar'];?>' width='150' height='150' alt=""/>					
						<br>
						<label>Image</label>
						<input type="file" name="nama_file1" value="<?php echo $kategori_gambar?>">
					</div>

					<div class="form-group">						
						<input type="submit" name="submit" class="btn btn-pri btn-sm" value="submit">
					</div>
				</form>
			</div>
		</div>
	</div>
