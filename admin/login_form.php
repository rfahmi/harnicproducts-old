<?php
session_start();

include("config.php");

if (isset($_POST['submit']))
	{
		$username = $_POST['username']; 
		$password = $_POST['password'];
		
		$sqlCommand = "SELECT * FROM users";
		$query = mysqli_query($link,$sqlCommand);
		
		while ($row = mysqli_fetch_array($query))
		{
			$admin = $row['username']; 
			$adminpass = $row['userpassword'];
						
			if (($username != $admin) || ($password != $adminpass)) 				  
				{ 
					$error_msg = '=>Your login information is incorrect';					
				}				
			else 
				{
					$_SESSION['admin'] = $username;
					echo "<meta http-equiv='refresh' content='1;url=index.php'>";
					exit();
				}				
		}
	}
?>	

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
  <title>Halaman Administrator</title>
  <meta name="description" content="Harnicproducts">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
  <link rel="stylesheet" href="../css/app.min.css" type="text/css">
</head>

<body>
  <div class="container ng-scope">  
   <div class="center-block w-xl w-auto-xs m-b-lg">
    <div class="text-2x m-v-lg text-primary ng-binding"><i class="glyphicon glyphicon-th-large text-xl"></i> Administrator</div>
    <div class="m-b text-sm ng-binding">
      Masukkan username dan password yang sudah dibuat
    </div>
		<form action="login_form.php" method="post">
		  <div class="form-group m-b-xs">
			<input type="text" placeholder="Username" name="username" class="form-control" >
		  </div>
		  <div class="form-group m-b-xs">
			<input type="password" placeholder="Password" name="password" class="form-control">
		  </div>      
		  
		  <button type="submit" name="submit" class="btn btn-info p-h-md m-v-lg">Masuk</button>
		</form>
    </div>
   </div>

	<div class="app-footer ng-scope">
	  <div class="p bg-white text-xs ng-scope">
		<div class="pull-right hidden-xs hidden-sm text-muted">
		  <strong class="ng-binding">harnicproducts.com</strong> - © Copyright 2018
		</div>
		<ul class="list-inline no-margin text-center-xs">   
		  <li>Sign in
			<a href="../index.php" target="_blank">Home</a>
		  </li>
		</ul>
	</div>
</body>
</html>
					


