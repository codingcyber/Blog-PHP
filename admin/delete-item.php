<?php
// I'll use this file to delete all the files and redirect to correct view-page.php file
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-admin.php');
include('includes/check-subscriber.php');
$sql = "SELECT * FROM users WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_SESSION['id']));
$user = $result->fetch(PDO::FETCH_ASSOC); 

if($user['role'] == 'administrator'){
	switch ($_GET['item']) {
		case 'category':
			$table = 'categories';
			$redirect = 'view-categories.php';
			break;
		case 'article':
			$table = 'posts';
			$redirect = 'view-articles.php';
			break;
		case 'page':
			$table = 'pages';
			$redirect = 'view-pages.php';
			break;
		case 'user':
			$table = 'users';
			$redirect = 'view-users.php';
			break;
		case 'widget':
			$table = 'widget';
			$redirect = 'view-widgets.php';
			break;
		default:
			$redirect = 'dashboard.php';
			break;
	}
}elseif($user['role'] == 'editor'){
	switch ($_GET['item']) {
		case 'category':
			$table = 'categories';
			$redirect = 'view-categories.php';
			break;
		case 'article':
			$table = 'posts';
			$redirect = 'view-articles.php';
			break;
		case 'page':
			$table = 'pages';
			$redirect = 'view-pages.php';
			break;
		default:
			$redirect = 'dashboard.php';
			break;
	}
}
if($user['role'] == 'administrator'){
	$DelSql = "DELETE FROM $table WHERE id=?";
	$result = $db->prepare($DelSql);
	$res = $result->execute(array($_GET['id']));
}elseif($user['role'] == 'editor'){
	$DelSql = "DELETE FROM $table WHERE id=? AND uid={$_SESSION['id']}";
	$result = $db->prepare($DelSql);
	$res = $result->execute(array($_GET['id']));
}
if($res){
	header("location: $redirect");
}else{
	echo "Failed to Delete Record";
	header("location: $redirect");
}
?>