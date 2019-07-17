<?php
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-admin.php');
include('includes/check-subscriber.php');
$sql = "SELECT * FROM users WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_SESSION['id']));
$user = $result->fetch(PDO::FETCH_ASSOC); 
if(isset($_GET) & !empty($_GET)){
	$id = $_GET['id'];
	switch ($_GET['type']) {
		case 'post':
			$table = 'posts';
			$redirect = "edit-article.php?id=$id";
			break;
		case 'page':
			$table = 'pages';
			$redirect = "edit-page.php?id=$id";
			break;
		default:
			$redirect = 'dashboard.php';
			break;
	}
	if($user['role'] == 'administrator'){
		$sql = "SELECT * FROM $table WHERE id=?";
		$result = $db->prepare($sql);
		$result->execute(array($_GET['id']));
		$post = $result->fetch(PDO::FETCH_ASSOC);
		$filepath = '../'.$post['pic'];
		if(unlink($filepath)){
			$sql = "UPDATE $table SET pic='', updated=NOW() WHERE id=?";
			$result = $db->prepare($sql);
			$res = $result->execute(array($_GET['id']));
			if($res){
				header("location: $redirect");
			}
		}
	}elseif($user['role'] == 'editor'){
		$sql = "SELECT * FROM $table WHERE id=? AND uid={$_SESSION['id']}";
		$result = $db->prepare($sql);
		$result->execute(array($_GET['id']));
		$post = $result->fetch(PDO::FETCH_ASSOC);
		$filepath = '../'.$post['pic'];
		if(unlink($filepath)){
			$sql = "UPDATE $table SET pic='', updated=NOW() WHERE id=? AND uid={$_SESSION['id']}";
			$result = $db->prepare($sql);
			$res = $result->execute(array($_GET['id']));
			if($res){
				header("location: $redirect");
			}
		}
	}
}
?>