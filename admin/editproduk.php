<?php
	include 'config.php';

	$produk=$_GET['produk'];
	$namakategori='';

	$query="select a.*,b.kategori_nama,b.kategori_parent from mstproduk2 a left join mstkategori b on a.kategori=b.kategori_id where produk='$produk'";
	$sql= mysqli_query($link,$query) or die(mysql_error());
	$data=mysqli_fetch_array($sql);
	if ($sql) {
		$kodeproduk=$data['kodeproduk'];
		$namaproduk=$data['namaproduk'];
		$deskripsi=$data['deskripsi'];
		$harga=$data['harga'];
		$kategori=$data['kategori'];
		$namakategori=$data['kategori_nama'];
	}
?>

	<div class="container">
		<h3>Edit Data Produk</h3>
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
									echo "upload GAGAL, ukuran file terlalu besar";
									break;
								case 4:
									echo "Kode Produk atau Nama Produk belum diisi";
									break;
							}
						?>
					</div>
				<?php endif?>

				<form action="action_ubah.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Product ID &nbsp;:&nbsp;</label>
						<input type="hidden" name="produk" value="<?php echo $produk?>">
						<input type="text" name="kodeproduk" class="form-control" placeholder="Isi Kode Produk" value="<?php echo $kodeproduk;?>">
					</div>
					<div class="form-group">
						<label>Product Name</label>
						<input type="text" name="namaproduk" class="form-control" placeholder="Isi Nama Produk" value="<?php echo $namaproduk;?>">
					</div>
					<div class="form-group">
						<label>Description</label>
						<textarea name="deskripsi" class="form-control" placeholder="isi deskripsi produk" rows="3"><?php echo $deskripsi;?></textarea>
					</div>
					<div class="form-group">
						<label>Price</label>
						<input type="text" name="harga" class="form-control" placeholder="Isi Harga Produk" value="<?php echo $harga;?>">
					</div>

					<div class="form-group">
						<label>Category</label>
						<select name="kategori" class="form-control">
						<?php

						$query="select a.*,concat(ifnull(concat(c.kategori_nama,'--->'),''),b.kategori_nama,'--->',a.kategori_nama) as nm_parent from mstkategori a left join mstkategori b on a.kategori_parent=b.kategori_id left join mstkategori c on b.kategori_parent=c.kategori_id where a.kategori_id not in(select kategori_parent from mstkategori) order by nm_parent";
						$sql= mysqli_query($link,$query) or die(mysql_error());
  						while ($data2=mysqli_fetch_array($sql)): 
  						?>
  							<option value='<?=$data2['kategori_id']?>' <?php if($kategori==$data2['kategori_id']) echo "selected";?>><?=$data2['nm_parent']?></option>					
						<?php
						endwhile;
					    ?>

						</select>
					</div>

					<div class="form-group">						
						<input type="submit" name="submit" class="btn btn-pri btn-sm" value="simpan">
						<input type="reset" name="reset" class="btn btn-default btn-sm" value="reset">
					</div>
				</form>
			</div>
		</div>
	</div>
