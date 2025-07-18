<?php
	include 'config.php';

	$produk=$_GET['produk'];
	$nama_file1='';

	$query="select namaproduk from mstproduk where produk='$produk'";
	$sql= mysqli_query($link,$query) or die(mysql_error());
	$data=mysqli_fetch_array($sql);
	if ($sql) {
		$namaproduk=$data['namaproduk'];
	}
?>

	<div class="container">
		<h3>Tambah Gambar Produk</h3>
		
		<hr>
		<h4><?php echo $namaproduk?></h4>
		<h5><?php echo $produk?></h5>
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
 
				<form action="action_tambahgambar.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Variant</label>
						
						<select name="varian" class="form-control">
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
					<div class="form-group">
						<label>Angel</label>
						<select name="angel" class="form-control">
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

					<div class="form-group">
					    <input type="hidden" name="produk" value="<?php echo $produk?>"> 
						<input type="hidden" name="kodegambar" value="<?php echo $kodegambar?>"> 
						<img src='../resource/img/product/<?php echo $nama_file1;?>' width='150' height='150' alt=""/>
						<label>Image</label>
						<input type="file" name="nama_file1" class="form-control" value="<?php echo $nama_file1?>">
                        <input type="hidden" name="gambardefault" value="0"> 
  					    <input type='checkbox' name='gambardefault' value='1' > Default Image <br>
						
					</div>
					<div class="form-group">						
						<input type="submit" name="submit" class="btn btn-pri btn-sm" value="simpan">
					</div>
					
				</form>
			</div>
		</div>
	</div>
