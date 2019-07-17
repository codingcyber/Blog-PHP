<?php 
require_once('includes/connect.php');
if(isset($_POST) & !empty($_POST)){
	// PHP Form Validations
    if(empty($_POST['comment'])){$errors[] = "Comment Field is Required";}
    // CSRF Token Validation
    if(isset($_POST['csrf_token'])){
        if($_POST['csrf_token'] === $_SESSION['csrf_token']){
        }else{
            $errors[] = "Problem with CSRF Token Verification";
        }
    }else{
        $errors[] = "Problem with CSRF Token Validation";
    }
    // CSRF Token Time Validation
    $max_time = 60*60*24;
    if(isset($_SESSION['csrf_token_time'])){
        $token_time = $_SESSION['csrf_token_time'];
        if(($token_time + $max_time) >= time()){
        }else{
            $errors[] = "CSRF Token Expired";
            unset($_SESSION['csrf_token']);
            unset($_SESSION['csrf_token_time']);
        }
    }else{
        unset($_SESSION['csrf_token']);
        unset($_SESSION['csrf_token_time']);
    }
    if(empty($errors)){
    	$sql = "INSERT INTO comments (uid, pid, comment, status) VALUES (:uid, :pid, :comment, 'disapproved')";
        $result = $db->prepare($sql);
        $values = array(':uid'      => $_POST['uid'],
                        ':pid'    => $_POST['pid'],
                        ':comment'  => strip_tags($_POST['comment'])
                        );
        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
        if($res){
        	$messages[] = 'Comment Submitted Successfully';
        }
    }
}
?>