<?php
include('includes/check-login.php');
require_once('../includes/connect.php');
if(isset($_GET) & !empty($_GET)){
	$id = $_GET['id'];
	$sql = "SELECT * FROM posts WHERE id=?";
	$result = $db->prepare($sql);
	$result->execute(array($_GET['id']));
	$post = $result->fetch(PDO::FETCH_ASSOC);
	$filepath = '../'.$post['pic'];
	if(unlink($filepath)){
		$sql = "UPDATE posts SET pic='', updated=NOW() WHERE id=?";
		$result = $db->prepare($sql);
		$res = $result->execute(array($_GET['id']));
		if($res){
			header("location: edit-article.php?id=$id");
		}
	}
}
?>