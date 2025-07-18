	
		<div class="row">
			<div class="col-sm-4">		<h3>Product List</h3>		</div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4 text-right" style="padding-top: 15px">
				<div class="dropdown">
				  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter By Category
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu dropdown-menu-right">
						<li><a href="index.php?hal=filterproduct&kode_divisi=1">Home</a></li>
						<li><a href="index.php?hal=filterproduct&kode_divisi=2">Kitchen</a></li>
						<li><a href="index.php?hal=filterproduct&kode_divisi=3">Health</a></li>
						<li><a href="index.php?hal=filterproduct&kode_divisi=4">Beauty</a></li>
				  </ul>
				</div>
		    </div>
		</div>
		<hr>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>No</th>
						<th>ProductCode</th>
						<th>ProductName</th>
						<th>Description</th>
						<th>Category</th>
						<th>Price</th>
						<th>Image</th>
						<th>Action</th>						
					</tr>
				</thead>
				<tbody>
				
				<?php
   			    include '../config.php';
				//pagination
				$sqlcount ="select count(1) from mstproduk a inner join mstkategori b on a.kategori=b.kategori_id left join mstkategori c on b.kategori_parent=c.kategori_id left join mstkategori d on c.kategori_parent=d.kategori_id where d.kategori_parent='$_GET[kode_divisi]' or d.kategori_id='$_GET[kode_divisi]'";
				$rscount=mysqli_fetch_array(mysqli_query($link,$sqlcount));
				$banyakdata=$rscount[0];
				$page=isset($_GET['page'])? $_GET['page']:1;
				$limit=5;

				$mulai_dari=$limit * ($page-1);
				//-----	 

					$query ="select a.*,b.kategori_nama,b.kategori_parent,ifnull((select gambar from imgproduk where produk=a.produk order by kodegambar limit 1),'XX')gambar from mstproduk a inner join mstkategori b on a.kategori=b.kategori_id left join mstkategori c on b.kategori_parent=c.kategori_id left join mstkategori d on c.kategori_parent=d.kategori_id where d.kategori_parent='$_GET[kode_divisi]' or d.kategori_id='$_GET[kode_divisi]' order by namaproduk limit $mulai_dari,$limit";
					$sql=mysqli_query($link,$query);
					$no=($page * $limit)-4;
					while ($data=mysqli_fetch_array($sql)):
					?>					
					<tr>
						<td><?php echo $no //$data['produk']?></td>
						<td><?php echo $data['kodeproduk']?></td>
						<td><?php echo $data['namaproduk']?></td>
						<td><?php echo $data['deskripsi']?></td>
						<td><?php echo $data['kategori_nama']?></td>
						<td><?php echo $data['harga']?></td>						
						<?php
							$gambar=$data['gambar'];
							if (file_exists('../resource/img/product/'.$gambar)){
							  echo "<td><img src='../resource/img/product/$gambar' width='150' height='150' alt=''/></td>";
							}else{
							  echo "<td><img src='../resource/img/no-product-image.png' width='150' height='150' alt=''/></td>";
							}
						?>						
						
						<td>
							<a href="index.php?hal=editproduk&produk=<?php echo $data['produk'] ?>" class="btn btn-default btn-sm">	
								<span class="glyphicon glyphicon-pencil"></span> Edit
	                        </a>
	                        <a href="index.php?hal=delproduk&produk=<?php echo $data['produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan dihapus?')">
	                        	<span class="glyphicon glyphicon-trash"></span> Delete
	                        </a>
	                        <a href="index.php?hal=gambarproduk&produk=<?php echo $data['produk'] ?>" class="btn btn-danger btn-sm">
	                        	<span class="glyphicon glyphicon-camera"></span> Image
	                        </a>
						</td>
                    </tr>
                
                    <?php
                    $no++;
	                endwhile;
    	            ?>
				</tbody>
			</table>
		</div>	
			<div class="row">
				<div class="col-xs-6">
	                <a href="index.php?hal=addproduk" class="btn btn-danger btn-sm">
	                   	<span class="glyphicon glyphicon-plus"></span>Add
	                </a>
				</div>
				<div class="col-xs-6 text-right">
                    <?php
                    $totalhal=ceil($banyakdata / $limit);
                    //echo $stotal
                    ?>
                    <ul class="pagination" style="margin: 0;">
                    	<?php
                    	  for ($i=1;$i <=$totalhal; $i++):
                    	?>
                    	<?php if ($page != $i): ?>
                    		<li><a href="index.php?hal=filterproduct&kode_divisi=<?=$_GET['kode_divisi']?>&page=<?=$i?>"><?=$i?></a></li>
                    	<?php else: ?>
                    		<li class="active"><a href="#"><?=$i?></a></li>
                    	<?php
	                    endif;
    		            endfor;
            		    ?>
            		</ul>
				</div>
			</div>				
	

