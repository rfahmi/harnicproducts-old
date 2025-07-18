		<div class="row">
			<div class="col-sm-4">		<h3>Category List</h3>		</div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4 text-right" style="padding-top: 15px">
				<div class="dropdown">
				  <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Filter By Category
				  <span class="caret"></span></button>
				  <ul class="dropdown-menu dropdown-menu-right">
						<li><a href="index.php?hal=filterkategori&kode_divisi=1">Home</a></li>
						<li><a href="index.php?hal=filterkategori&kode_divisi=2">Kitchen</a></li>
						<li><a href="index.php?hal=filterkategori&kode_divisi=3">Health</a></li>
						<li><a href="index.php?hal=filterkategori&kode_divisi=4">Beauty</a></li>
				  </ul>
				</div>
		    </div>
		</div>
		<hr>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<h4><?php$_GET['kode_divisi']?></h>
					<tr>
						<th>No</th>
						<th>Category</th>
						<th>SubCategory</th>
						<th>SubSubCategory</th>
						<th>Image</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
					 include 'config.php';

				$sqlcount ="select count(1) from Mstkategori a left join mstkategori b on a.kategori_parent=b.kategori_id left join mstkategori c on b.kategori_parent=c.kategori_id where a.kategori_id not in(select kategori_parent from mstkategori) and ifnull(c.kategori_id,b.kategori_id)='$_GET[kode_divisi]'";
				$rscount=mysqli_fetch_array(mysqli_query($link,$sqlcount));
				$banyakdata=$rscount[0];
				$page=isset($_GET['page'])? $_GET['page']:1;
				$limit=5;

				$mulai_dari=$limit * ($page-1);
				//-----	 
					//$query ="select a.kategori_id,ifnull(c.kategori_id,b.kategori_id)parent_id,ifnull(c.kategori_nama,b.kategori_nama) Category,case when c.kategori_nama is null then a.kategori_nama else b.kategori_nama end SubCategory,case when c.kategori_nama is null then '' else a.kategori_nama end SubSubCategory,ifnull(c.kategori_gambar,b.kategori_gambar)kategori_gambar from mstkategori a left join mstkategori b on a.kategori_parent=b.kategori_id left join mstkategori c on b.kategori_parent=c.kategori_id where a.kategori_id not in(select kategori_parent from mstkategori) and ifnull(c.kategori_id,b.kategori_id)='$_GET['kode_divisi']' order by Category,SubCategory,SubSubCategory limit $mulai_dari,$limit";
					$query ="select a.kategori_id,ifnull(c.kategori_id,b.kategori_id)parent_id,ifnull(c.kategori_nama,b.kategori_nama) Category,case when c.kategori_nama is null then a.kategori_nama else b.kategori_nama end SubCategory,case when c.kategori_nama is null then '' else a.kategori_nama end SubSubCategory,a.kategori_gambar from mstkategori a left join mstkategori b on a.kategori_parent=b.kategori_id left join mstkategori c on b.kategori_parent=c.kategori_id where a.kategori_id not in(select kategori_parent from mstkategori) and ifnull(c.kategori_id,b.kategori_id)='$_GET[kode_divisi]' order by Category,SubCategory,SubSubCategory limit $mulai_dari,$limit";
					$sql=mysqli_query($link,$query);
					$no=($page * $limit)-4;
					while ($data=mysqli_fetch_array($sql)):
					?>					
					<tr>
						<td><?php echo $no?></td>
						<td><?php echo $data['Category']?></td>
						<td><?php echo $data['SubCategory']?></td>
						<td><?php echo $data['SubSubCategory']?></td>						
						<td><img src="../resource/img/kategori/<?php echo $data['kategori_gambar']?>" width='250' height='150' alt=''/></td>
						<td>
							<a href="index.php?hal=editkategori&kategori_id=<?php echo $data['kategori_id'] ?>" class="btn btn-default btn-sm">	
								<span class="glyphicon glyphicon-pencil"></span>Edit
	                        </a>
	                        <a href="index.php?hal=delkategori&kategori_id=<?php echo $data['kategori_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan dihapus?')">
	                        	<span class="glyphicon glyphicon-trash"></span>Del
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
	                <a href="index.php?hal=addkategori" class="btn btn-danger btn-sm">
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
                    		<li><a href="index.php?hal=filterkategori&page=<?=$i?>"><?=$i?></a></li>
                    	<?php else: ?>
                    		<li class="active"><a href="#"><?=$i?></a></li>
                    	<?php
	                    endif;
    		            endfor;
            		    ?>
            		</ul>
				</div>
			</div>				
