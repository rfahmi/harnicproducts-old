<?php
include 'config.php';

try {
    // Sanitize input
    $produk = isset($_GET['produk']) ? $db->escape($_GET['produk']) : '';
    $nama_file = '';
    $namaproduk = '';

    if (empty($produk)) {
        echo "<div class='alert alert-danger'>Product ID is required</div>";
        echo "<meta http-equiv='refresh' content='2;url=index.php'>";
        exit;
    }

    // Get product details using prepared statement
    $query = "SELECT * FROM mstproduk2 WHERE produk = ?";
    $stmt = $db->prepare($query);
    $stmt->bind_param("s", $produk);
    $stmt->execute();
    $result = $stmt->get_result();

if ($result && $data = mysqli_fetch_array($result)) {
    $namaproduk = $data['namaproduk'];
} else {
    echo "<div class='alert alert-danger'>Product not found</div>";
    echo "<meta http-equiv='refresh' content='2;url=index.php'>";
    exit;
}
?>
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3><?php echo htmlspecialchars($namaproduk); ?></h3>
        <div>
            <a href="index.php?hal=listproduk" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Back to Product List
            </a>
            <a href="addgambar.php?produk=<?php echo htmlspecialchars($produk); ?>" class="btn btn-primary">
                <i class="fas fa-plus"></i> Add Image
            </a>
        </div>
    </div>
<tbody>
  <?php
    // Count total images for pagination
    $sqlcount = "SELECT COUNT(1) FROM imgproduk WHERE produk = ?";
    $stmt = mysqli_prepare($link, $sqlcount);
    mysqli_stmt_bind_param($stmt, "s", $produk);
    mysqli_stmt_execute($stmt);
    $countResult = mysqli_stmt_get_result($stmt);
    $banyakdata = ($countResult && $row = mysqli_fetch_array($countResult)) ? $row[0] : 0;

    // Pagination parameters
    $page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
    $limit = 8;
    $mulai_dari = $limit * ($page - 1);

    // Main query with basic information
    $query = "SELECT 
                i.*,
                LEFT(CONCAT(IFNULL(i.gambar,''), REPEAT('.', 25)), 25) as notes
              FROM imgproduk i 
              WHERE i.produk = ? 
              LIMIT ?, ?";

    if (!($stmt = mysqli_prepare($link, $query))) {
        echo "<div class='alert alert-danger'>Error preparing statement: " . mysqli_error($link) . "</div>";
        exit;
    }
    
    if (!mysqli_stmt_bind_param($stmt, "sii", $produk, $mulai_dari, $limit)) {
        echo "<div class='alert alert-danger'>Error binding parameters: " . mysqli_stmt_error($stmt) . "</div>";
        exit;
    }
    
    if (!mysqli_stmt_execute($stmt)) {
        echo "<div class='alert alert-danger'>Error executing statement: " . mysqli_stmt_error($stmt) . "</div>";
        exit;
    }
    
    $sql = mysqli_stmt_get_result($stmt);

    if (!$sql) {
        echo "<div class='alert alert-danger'>Error retrieving images: " . mysqli_error($link) . "</div>";
        exit;
    }
	$no=($page * $limit)-7;
	while ($data=mysqli_fetch_array($sql)):	   
  ?>			

  <div class="col-md-3">  
    <div class="panel panel-primary">
	    <div class="panel-body" >		
		<?php 			
			$gambar=$data['gambar'];
			if (file_exists('../resource/img/product/'.$gambar)){
			  echo "<img src='../resource/img/product/$gambar' width='150' height='150' alt=''";
			}else{
			  echo "<img src='../resource/img/no-product-image.png' width='150' height='150' alt=''";
			}
			$notes=$data['notes'];
			$gambardefault=$data['gambardefault'];			
		?>			
			<br>
			<text style="color:#000033"> <?php echo $notes?> </text>
			<br>
			<a href="index.php?hal=editgambar&kodegambar=<?php echo $data['kodegambar']?> &produk=<?php echo $data['produk']?>" class="btn btn-default btn-sm">	
				<span class="glyphicon glyphicon-pencil"></span> Edit
			</a>
			<a href="index.php?hal=delgambar&kodegambar=<?php echo $data['kodegambar'] ?>&produk=<?php echo $data['produk'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin akan dihapus?')">
				<span class="glyphicon glyphicon-trash"></span> Delete
			</a>	
			<br>
			<?php 
			 if ($gambardefault==1) { 			   
			   echo "<text style='background-color:#3385ff;color:white'>>>>    Default Image   <<<</text>";
			   }else {echo "<text>.</text>";}
			?>   			
	    </div>
	</div>
   </div>
   <?php
		$no++;
		endwhile;
   ?>
</tbody>

		<div class="row">
				<div class="col-xs-6">				             
	                <a href="index.php?hal=addgambar&produk=<?php echo $produk?>" class="btn btn-danger btn-sm">
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
                    		<li><a href="index.php?hal=gambarproduk&produk=<?php echo $produk?>&page=<?=$i?>"><?=$i?></a></li>
                    	<?php else: ?>
                    		<li class="active"><a href="#"><?=$i?></a></li>
                    	<?php
	                         endif;
    		            endfor;
            		    ?>
            		</ul>
				</div>
			</div>				


<script>
function myFunction() {
    var checkBox = document.getElementById("myCheck");
    var text = document.getElementById("text");
    if (checkBox.checked == true){
        text.style.display = "block";
    } else {
       text.style.display = "none";
    }
}
</script> 			