<?php
// check the page
//echo basename($_SERVER['PHP_SELF']);
if((basename($_SERVER['PHP_SELF']) == 'login.php') || (basename($_SERVER['PHP_SELF']) == 'register.php')){
	if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
		$sql = "SELECT * FROM users WHERE id=?";
		$result = $db->prepare($sql);
		$result->execute(array($_SESSION['id']));
		$user = $result->fetch(PDO::FETCH_ASSOC); 

		if(($user['role'] == 'administrator') || ($user['role'] == 'editor')){
			//echo "role: admin/editor";
			// redirect to dashboard page
			header("location: http://localhost/Blog-PHP/admin/dashboard.php");
		}elseif($user['role'] == 'subscriber'){
			//echo "role: subscriber";
			// redirect to Blog Home page
			header("location: http://localhost/Blog-PHP/index.php");
		}
	}
}
?>