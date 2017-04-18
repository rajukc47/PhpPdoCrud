<?php
require "db.php";

if(isset($_POST['register']))
	{
		$fullname=$_POST['fullname'];
		$username=$_POST['username'];
		$password=$_POST['password'];
		$email=$_POST['email'];

		if(empty($fullname) || empty($username) || empty($password) || empty($email))
		{
			$message="All Fields Are Required!";
		}
		else
		{
			$query="INSERT INTO tbl_user(fullname,username,password,email) VAlUES(:fullname,:username:password,:email)";
			$stmt=$connect->prepare($query);
			$stmt->bindValue('fullname',$fullname);
			$stmt->bindValue('username',$username);
			$stmt->bindValue('password',$password);
			$stmt->bindValue('email',$email);
			$flag=$stmt->execute();
			if($flag){
				$message="Data Successfully Inserted.";
			}
			else{
				$message="Data Failed to Insert.";
			}
		}
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration Form</title>
	<?php include('top.inc.php'); ?>
</head>
<body>
<div class="container" style="width: 500px;">
	<h1>Registration Form</h1>
	<?php
		echo isset($message)?"<p class='alert alert-danger'>$message</p>":'';
	?>
<form class="form-horizontal" method="post">
  <div class="form-group">
    <label class="control-label col-sm-2" for="fullname">Fullname:</label>
    <div class="col-sm-10">
      <input type="text" name="fullname" class="form-control" id="fullname" placeholder="Enter Fullname">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <div class="col-sm-10">
      <input type="text" name="username" class="form-control" id="username" placeholder="Enter Username">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="password">Password:</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter Password">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10"> 
      <input type="email" name="email" class="form-control" id="email" placeholder="Enter Email">
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="register" class="btn btn-info">Register</button>
    </div>
  </div>
</form>
	<a href="login.php">Click Here To Login</a>
</div>
</body>
</html>