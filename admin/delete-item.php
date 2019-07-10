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
	default:
		# code...
		break;
}
$DelSql = "DELETE FROM $table WHERE id=?";
$result = $db->prepare($DelSql);
$res = $result->execute(array($_GET['id']));
if($res){
	header("location: $redirect");
}else{
	echo "Failed to Delete Record";
}
?>