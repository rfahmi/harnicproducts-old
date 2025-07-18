<?php
session_start();
include("config.php");
	
if (empty($_SESSION['admin'])) {  header("location:login_form.php");  }

?>

<!doctype html>
<html lang=''>
 <head>
   <meta charset='utf-8'>
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="../css/styles.css">
   <link rel="stylesheet" type="text/css" href="../css/bootstrap337.min.css">   
   <!--<script src="http://code.jquery.com/jquery-latest.min.js" type="text/javascript"></script>-->
   <script src="../js/jquery-3.1.1.min.js"></script>
   <script src="../js/script.js"></script>
   <title>Administrator</title>
 </head>
 <body>

 <div style="margin:10px auto ; width:95%; background-color:#66665e;padding:10px 0; text-align:center;border-radius:5px; color:#fff;font-family: calibri;" ><marquee>Halaman Administrator</marquee></div>

 <div style="margin:0 auto ; width:95%">
	<div style="float:left;margin-right:10px;width:250px;">
		<div id='cssmenu'>
		<ul>
		   <li class='active'><a href='..\index.php'><span>harnicproducts.com</span></a></li>
		   <li class='has-sub'><a href='#'><span>Product</span></a>
		      <ul>
		         <li><a href='index.php?hal=listproduk'><span>Product List</span></a></li>
		         <li><a href='index.php?hal=addproduk'><span>Add Product</span></a></li>
		      </ul>
		   </li>
		   <li class='has-sub'><a href='#'><span>Category</span></a>
		      <ul>
		         <li><a href='index.php?hal=listkategori'><span>Category List</span></a></li>
		         <li><a href='index.php?hal=addkategori'><span>Add Category</span></a></li>
		      </ul>
		   </li>
		   <li class='has-sub'><a href='index.php?hal=listviewer'><span>Viewer</span></a>
		   </li>		   
		   <li class='has-sub'><a href='#'><span>Image Slide</span></a>
		      <ul>
		         <li><a href='index.php?hal=listslide'><span>Image List</span></a></li>
		         <li><a href='index.php?hal=addslide'><span>Add Image</span></a></li>
		      </ul>
		   </li>
		   <li class='last'><a href='logout.php'><span>Logout</span></a></li>
		</ul>
		</div>
	</div>

<!--CONTENT-->
	<div style="width:79%; min-height:400px; background-color:#F2F1EF;float:left;border-radius:5px;padding:0 10px">
		<?php

          if(isset($_GET['hal'])){
          	$hal=$_GET['hal'];          	
          } else {
          	$hal='home';
          }

          if ($hal=='home') {
          	include 'listproduk.php';
          } elseif ($hal=='listproduk'){
          	include 'listproduk.php';
          } elseif ($hal=='addproduk'){
          	include 'addproduk.php';
          } elseif ($hal=='editproduk'){
          	include 'editproduk.php';
          } elseif ($hal=='delproduk'){
          	include 'delproduk.php';
          } elseif ($hal=='delgambar'){
          	include 'delgambar.php';
          } elseif ($hal=='delkategori'){
          	include 'delkategori.php';			
          } elseif ($hal=='filterproduct'){
          	include 'filterproduct.php';
          } elseif ($hal=='cariproduk'){
          	include 'cariproduk.php';
 		  } elseif ($hal=='gambarproduk'){
            include 'gambarproduk.php';            			
 		  } elseif ($hal=='addgambar'){
            include 'addgambar.php';            			
			} elseif ($hal=='editgambar'){
            include 'editgambar.php';            			
          } elseif ($hal=='addkategori'){
            include 'addkategori.php';            
          } elseif ($hal=='editkategori'){
            include 'editkategori.php';            
          } elseif ($hal=='listkategori'){
          	include 'listkategori.php';
          } elseif ($hal=='listviewer'){
          	include 'listviewer.php';
          } elseif ($hal=='filterkategori'){
          	include 'filterkategori.php';
			}
		  
		?>

	</div>
<!--=================-->	
</div>
<script src="../js/jQuery331.js"></script>
<script src="../js/bootstrap337.min.js"></script>	
</body>
</html>


