		<div class="row">
			<div class="col-sm-4">		<h3>Viewer List</h3>		</div>
			<div class="col-sm-4"></div>
			<div class="col-sm-4 text-right" style="padding-top: 15px">
		    </div>
		</div>

		<hr>
		<div class="table-responsive">
			<table class="table table-bordered table-striped table-hover">
				<thead>
					<tr>
						<th>Date</th>
						<th>Viewer</th>
					</tr>
				</thead>
				<tbody>
					<?php
					include 'config.php';

					$sqlcount ="select accessdate from statistik group by accessdate";
					$rscount=mysqli_fetch_array(mysqli_query($link,$sqlcount));
					$banyakdata=$rscount[0];
					$page=isset($_GET['page'])? $_GET['page']:1;
					$limit=5;

					$mulai_dari=$limit * ($page-1);

					$query ="select accessdate,count(1) pengunjung from statistik group by accessdate order by accessdate desc limit $mulai_dari,$limit";
					$sql=mysqli_query($link,$query);
					$no=($page * $limit)-4;
					while ($data=mysqli_fetch_array($sql)):
					?>					
					<tr>
						<td><?php echo $data['accessdate']?></td>
						<td><?php echo $data['pengunjung']?></td>
									
                    </tr>
                
                    <?php
                    $no++;
	                endwhile;
    	            ?>
				</tbody>
			</table>
		</div>
			<div class="row">
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
                    		<li><a href="index.php?hal=listviewer&page=<?=$i?>"><?=$i?></a></li>
                    	<?php else: ?>
                    		<li class="active"><a href="#"><?=$i?></a></li>
                    	<?php
	                    endif;
    		            endfor;
            		    ?>
            		</ul>
				</div>
			</div>				
