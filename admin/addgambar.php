<?php
	include 'config.php';

	$produk=$_GET['produk'];
	$nama_file1='';

	$query="select namaproduk from mstproduk2 where produk='$produk'";
	$sql= mysqli_query($link,$query) or die(mysql_error());
	$data=mysqli_fetch_array($sql);
	if ($sql) {
		$namaproduk=$data['namaproduk'];
	}
?>

	<div class="container mt-4">
		<div class="card">
			<div class="card-header">
				<h3 class="mb-0">Tambah Gambar Produk</h3>
			</div>
			<div class="card-body">
				<div class="product-info mb-4">
					<h4 class="text-primary mb-2"><?php echo $namaproduk?></h4>
					<h5 class="text-muted"><?php echo $produk?></h5>
				</div>
				<div class="row">
					<div class="col-md-8">
						<?php
						if(isset($_GET['status'])):?>

					<div class="alert <?php echo $status == 0 ? 'alert-success' : 'alert-danger'; ?> alert-dismissible fade show">
						<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
						<?php
							$status=$_GET['status'];
							switch($status){
								case 0:
									echo "<i class='fas fa-check-circle'></i> Upload berhasil!";
									break;
								case 1:
									echo "<i class='fas fa-exclamation-circle'></i> Silakan pilih file untuk diupload";
									break;
								case 2:
									echo "<i class='fas fa-exclamation-triangle'></i> Upload gagal! Format file harus JPG, PNG atau GIF";
									break;
								case 3:
									echo "<i class='fas fa-exclamation-triangle'></i> Upload gagal! Ukuran file terlalu besar";
									break;
								case 4:
									echo "<i class='fas fa-exclamation-circle'></i> Kode Produk atau Nama Produk belum diisi";
									break;
							}
						?>
					</div>
				<?php endif?>
 
				<form action="action_tambahgambar.php" method="post" enctype="multipart/form-data">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group mb-4">
								<label class="form-label">Variant</label>
								<select name="varian" class="form-control form-select">
								<?php
								$query="select * from mstvarian order by namavarian";
								$sql= mysqli_query($link,$query) or die(mysql_error());
								while ($data2=mysqli_fetch_array($sql)): 
									?>  							  	
									<option value='<?=$data2['varian']?>'><?=$data2['namavarian']?></option>		
									<?php
								endwhile;
								?>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group mb-4">
								<label class="form-label">Angel</label>
								<select name="angel" class="form-control form-select">
								<?php
								$query="select * from mstangel order by namaangel";
								$sql= mysqli_query($link,$query) or die(mysql_error());
								while ($data2=mysqli_fetch_array($sql)): 
									?>
									<option value='<?=$data2['angel']?>'><?=$data2['namaangel']?></option>		
									<?php
								endwhile;
								?>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group mb-4">
						<input type="hidden" name="produk" value="<?php echo $produk?>"> 
						<input type="hidden" name="kodegambar" value="<?php echo $kodegambar?>">
						
						<label class="form-label">Preview</label>
						<div class="mb-3">
							<?php if($nama_file1): ?>
								<img src='../resource/img/product/<?php echo $nama_file1;?>' class="img-thumbnail" style="max-width: 200px;" alt="Product Preview"/>
							<?php else: ?>
								<div class="text-muted">No image selected</div>
							<?php endif; ?>
						</div>
						
						<label class="form-label">Upload Image</label>
						<input type="file" name="nama_file1" class="form-control" accept="image/jpeg,image/png,image/gif" value="<?php echo $nama_file1?>">
						<div class="form-text text-muted">Accepted formats: JPG, PNG, GIF</div>
						
						<div class="form-check mt-3">
							<input type="hidden" name="gambardefault" value="0"> 
							<input type="checkbox" name="gambardefault" value="1" class="form-check-input" id="defaultImage">
							<label class="form-check-label" for="defaultImage">Set as Default Image</label>
						</div>
					</div>
					
					<div class="form-group">
						<button type="submit" name="submit" class="btn btn-primary">
							<i class="fas fa-save"></i> Simpan
						</button>
						<a href="gambarproduk.php?produk=<?php echo $produk?>" class="btn btn-secondary">
							<i class="fas fa-times"></i> Batal
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
