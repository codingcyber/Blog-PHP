<?php
$sql = "SELECT * FROM users WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_SESSION['id']));
$user = $result->fetch(PDO::FETCH_ASSOC); 

if($user['role'] == 'subscriber'){
	header("location: http://localhost/Blog-PHP/index.php");
}
?>