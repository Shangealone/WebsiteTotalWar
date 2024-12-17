<?php
    session_start();
    if(!isset($_SESSION['user_level']) or ($_SESSION['user_level'] != 1)) { //admin can only access
        header("Location: login.php");
        exit();
    }
?>

<!doctype html>
<html lang="en">
	<head>
		<title>Total War Fandom</title>
		<meta charset=utf-8>
		<link rel="stylesheet" type="text/css" href="css/includes.css">
		<meta charset= "UTF-8" />
		<meta name= "viewport" content = "width = device-width, initial-scale=1.0" />
		<link rel="stylesheet" href = "style.css">
		<script src="https://kit.fontawesome.com/a076d05399.js"></script>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
	</head>

	<body class="header">
		<div>
		<?php include('header_admin.php');?>
		<hr>
		<?php include('navigation_admins.php');?>
	</br>	</br>	</br> 
		<?php include('info_col_admins.php');?>
		
		<?php include('footer.php');?>
    </body>
</html>