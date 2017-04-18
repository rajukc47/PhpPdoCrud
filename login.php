<?php
session_start();
define('HOSTNAME','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DBNAME','db_test');
$message = null;

try
{
	$connect=new PDO("mysql:host=".HOSTNAME.";dbname=".DBNAME,USERNAME,PASSWORD);
	$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	if(isset($_POST['login']))
	{
		$uname=$_POST['username'];
		$pword=$_POST['password'];

		if(empty($uname) || empty($pword))
		{
			$message="All Fields Are Required!";
		}
		else
		{
			$query="SELECT * FROM tbl_user WHERE username=:username AND password=:password";
			$stmt=$connect->prepare($query);
			$stmt->execute(array('username'=>$uname,'password'=>$pword));
			$count=$stmt->rowCount();
			if($count>0){
				$_SESSION['username']=$uname;
				header("location:admin.php");
			}
			else{
				$message="Invalid Username or Password!";
			}
		}
	}
}
catch(PDOException $e)
{
	$message=$e->getMessage();
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Login Form</title>
	<?php include('top.inc.php'); ?>
</head>
<body>
<div class="container" style="width: 500px;">
	<h1>Login Form</h1>
	<?php
		echo isset($message)?"<p class='alert alert-danger'>$message</p>":'';
	?>
	<form method="post">
		<label>Username </label>
		<input type="text" name="username" class="form-control"><br />
		<label>Password </label>
		<input type="password" name="password" class="form-control"><br />
		<input type="submit" name="login" value="Login" class="btn btn-info">
	</form>
	<a href="register.php">Register Here</a>
</div>
</body>
</html>