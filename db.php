<?php
define('HOSTNAME','localhost');
define('USERNAME','root');
define('PASSWORD','');
define('DBNAME','db_test');
$message = null;

try
{
	$connect=new PDO("mysql:host=".HOSTNAME.";dbname=".DBNAME,USERNAME,PASSWORD);
	$connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

	}
catch(PDOException $e)
{
	$message=$e->getMessage();
}
?>