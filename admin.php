<?php
session_start();
if(!isset($_SESSION['username'])){
	header("location:login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Admin Panel</title>
	<?php include('top.inc.php'); ?>
</head>
<body>
<div class="container">
	<h1>Welcome To Admin Panel.</h1>
	<p>Hello <?php echo $_SESSION['username'];?> !!! <a href="logout.php">Log Out</a></p>
</div>
</body>
</html>