<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-admin.php');
include('includes/check-subscriber.php'); 
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
        // TODO : Only user with Administrator privillages or user who created the article can only edit 

        $sql = "UPDATE comments SET comment=:comment, status=:status, updated=NOW() WHERE id=:id";
        $result = $db->prepare($sql);
        $values = array(':comment'  => $_POST['comment'],
                        ':status'   => $_POST['status'],
                        ':id'       => $_POST['id'],
                        );
        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
        if($res){
            header("location: comments.php");
        }else{
            $errors[] = "Failed to Update Comment";
        }
    }
}
// Create CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();

include('includes/header.php');
include('includes/navigation.php'); 

$sql = "SELECT comments.id, comments.comment, comments.status, posts.title FROM comments INNER JOIN posts ON comments.pid=posts.id WHERE comments.id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id'])) or die(print_r($result->errorInfo(), true));
$comment = $result->fetch(PDO::FETCH_ASSOC);
?>
<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Article</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create a New Article Here...
                </div>
                <div class="panel-body">
                    <?php
                        if(!empty($messages)){
                            echo "<div class='alert alert-success'>";
                            foreach ($messages as $message) {
                                echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;". $message ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <?php
                        if(!empty($errors)){
                            echo "<div class='alert alert-danger'>";
                            foreach ($errors as $error) {
                                echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;". $error ."<br>";
                            }
                            echo "</div>";
                        }
                    ?>
                    <div class="row">
                        <div class="col-lg-12">
                            <form role="form" method="post" enctype="multipart/form-data">
                                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <div class="form-group">
                                    <label>Article Title</label>
                                    <input class="form-control" name="title" placeholder="Enter Article Title" value="<?php if(isset($comment['title'])){ echo $comment['title'];} ?>" disabled>
                                </div>
                                <div class="form-group">
                                    <label>Comment</label>
                                    <textarea class="form-control" name="comment" rows="3"><?php if(isset($comment['comment'])){ echo $comment['comment'];} ?></textarea>
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Comment Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios1" value="approved" <?php if($comment['status'] == 'approved'){ echo "checked"; } ?>>Approved
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios2" value="disapproved" <?php if($comment['status'] == 'disapproved'){ echo "checked"; } ?>>Disapproved
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <input type="submit" class="btn btn-success" value="Submit" />
                            </form>
                        </div>
                        <!-- /.col-lg-6 (nested) -->   
                    <!-- /.row (nested) -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<?php include('includes/footer.php'); ?>