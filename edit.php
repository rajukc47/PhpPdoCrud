<?php
require "db.php";

if(isset($_POST['update']))
	{
		$id=$_POST['id'];
		$fullname=$_POST['fullname'];
		$username=$_POST['username'];
		$email=$_POST['email'];

		if(empty($fullname) || empty($username) ||  empty($email))
		{
			$message="All Fields Are Required!";
		}
		else
		{
			$query="UPDATE tbl_user SET fullname=:fullname,username=:username,email=:email WHERE id=:id";
			$stmt=$connect->prepare($query);
			$stmt->bindValue('fullname',$fullname);
			$stmt->bindValue('username',$username);
			$stmt->bindValue('email',$email);
			$stmt->bindValue('id',$id);
			$stmt->execute();
			header('location:admin.php');
		}
}
//for getting value to edit
if(isset($_GET['id']))
{
	$id=$_GET['id'];
	$query="SELECT * FROM tbl_user WHERE id=:id";
	$stmt=$connect->prepare($query);
	$stmt->bindValue('id',$id);
	$stmt->execute();
	$edit=$stmt->fetch(PDO::FETCH_OBJ);
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
	<h1>Edit Form Form</h1>
	<?php
		echo isset($message)?"<p class='alert alert-danger'>$message</p>":'';
	?>
<form class="form-horizontal" method="post">
	<input type="hidden" name="id" value="<?php echo $edit->id;?>">
  <div class="form-group">
    <label class="control-label col-sm-2" for="fullname">Fullname:</label>
    <div class="col-sm-10">
      <input type="text" name="fullname" class="form-control" id="fullname" value="<?php echo $edit->fullname;?>" placeholder="Enter Fullname">
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="username">Username:</label>
    <div class="col-sm-10">
      <input type="text" name="username" value="<?php echo $edit->username;?>" class="form-control" id="username" placeholder="Enter Username">
    </div>
  </div>
  
  <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email:</label>
    <div class="col-sm-10"> 
      <input type="email" name="email" value="<?php echo $edit->email;?>" class="form-control" id="email" placeholder="Enter Email">
    </div>
  </div>
  
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="update" class="btn btn-info">Update</button>
    </div>
  </div>
</form>
</div>
</body>
</html>