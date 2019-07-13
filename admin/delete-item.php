<?php
// I'll use this file to delete all the files and redirect to correct view-page.php file
include('includes/check-login.php');
require_once('../includes/connect.php');
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
$DelSql = "DELETE FROM $table WHERE id=?";
$result = $db->prepare($DelSql);
$res = $result->execute(array($_GET['id']));
if($res){
	header("location: $redirect");
}else{
	echo "Failed to Delete Record";
	header("location: $redirect");
}
?>