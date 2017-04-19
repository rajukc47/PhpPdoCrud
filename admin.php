<?php
session_start();
if(!isset($_SESSION['username'])){
	header("location:login.php");
}
//for db connection
require "db.php";

//for delete operation
if(isset($_GET['action']) && $_GET['action']=='delete')
{
	$id=$_GET['id'];
	$query="DELETE FROM tbl_user WHERE id=:id";
	$stmt=$connect->prepare($query);
	$stmt->bindValue('id',$id);
	$stmt->execute();
	header('location:admin.php');
}	


//for displaying users list
$query="SELECT * FROM tbl_user ORDER BY id DESC";
$stmt=$connect->prepare($query);
$stmt->execute();

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
	<table class="table table-striped">
		<thead>
			<tr>
				<th>SN</th>
				<th>Fullname</th>
				<th>Username</th>
				<th>Email</th>
				<th>#</th>
			</tr>
		</thead>
		<tbody>
		<?php 
		$sn=1;
		while($row=$stmt->fetch(PDO::FETCH_ASSOC)): 
		?>
			<tr>
				<td><?php echo $sn++; ?></td>
				<td><?php echo $row['fullname'];?></td>
				<td><?php echo $row['username'];?></td>
				<td><?php echo $row['email'];?></td>
				<td><a href="edit.php?id=<?php echo $row['id'];?>">Edit</a> | 
				<a href="admin.php?action=delete&id=<?php echo $row['id'];?>" onclick="return confirm('Are you sure to Delete?');">Delete</a></td>
			</tr>
		<?php endwhile; ?>
		</tbody>
	</table>
</div>
</body>
</html>