<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-admin.php');
include('includes/check-subscriber.php');
if(isset($_GET) & !empty($_GET)){
	$sql = "UPDATE comments SET status=:status, updated=NOW() WHERE id=:id";
	$result = $db->prepare($sql);
	$values = array(':status'	=> $_GET['status'],
	                ':id'  		=> $_GET['id']
	                );
	$res = $result->execute($values) or die(print_r($result->errorInfo(), true));
	if($res){
		header("location: comments.php");
	}
}else{
	header("location: comments.php");
}
 ?>}
