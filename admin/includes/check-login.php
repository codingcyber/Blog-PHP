<?php
session_start();
if(isset($_SESSION['login']) & ($_SESSION['login'] == true)){
}else{
	// redirect user to login page
	header('location:login.php');
}
if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
}else{
	// redirect user to login page
	header('location:login.php');
}
if(isset($_SESSION['last_login']) & !empty($_SESSION['last_login'])){
}else{
	// redirect user to login page
	header('location:login.php');
}

if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
	$sql = "SELECT * FROM users WHERE id=?";
	$result = $db->prepare($sql);
	$result->execute(array($_SESSION['id']));
	$user = $result->fetch(PDO::FETCH_ASSOC); 

	if($user['role'] == 'subscriber'){
		//echo "role: subscriber";
		// redirect to Blog Home page
		header("location: http://localhost/Blog-PHP/index.php");
	}
}
?>