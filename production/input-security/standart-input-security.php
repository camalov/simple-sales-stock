<?php  
ob_start();
session_start();

if(!isset($_SESSION['user'])){
	Header("Location:logout.php");
}


?>		