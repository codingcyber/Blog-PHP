<?php 
require_once('../includes/connect.php');
include('includes/check-login.php'); 
include('includes/check-subscriber.php');
if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['title'])){$errors[] = "Title Field is Required";}
    //if(empty($_FILES['pic']['name'])){$errors[] = "You Should Upload a File";}
    if(empty($_POST['slug'])){$slug = trim($_POST['title']); }else{$slug = trim($_POST['slug']);}
    // check slug is unique with db query
    $search = array(" ", ",", ".", "_");
    $slug = strtolower(str_replace($search, '-', $slug));
    $sql = "SELECT * FROM categories WHERE slug=:slug AND id <> :id";
    $result = $db->prepare($sql) or die(print_r($result->errorInfo(), true));
    $values = array(':slug'     => $_POST['slug'],
                    ':id'       => $_POST['id']
                    );
    $result->execute($values);
    $count = $result->rowCount();
    if($count == 1){
        $errors[] = "Slug already exists in database";
    }
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
        // Update SQL Query
        $sql = "UPDATE categories SET title=:title, description=:description, slug=:slug, updated=NOW() WHERE id=:id";
        $result = $db->prepare($sql);
        $values = array(':title'            => $_POST['title'],
                        ':description'      => $_POST['description'],
                        ':slug'             => $_POST['slug'],
                        ':id'               => $_POST['id']
                        );
        $res = $result->execute($values);
        if($res){
            header('location:view-categories.php');
        }else{
            $errors[] = "Failed to Add Category";
        }
    }
}
// Create CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();

include('includes/header.php');
include('includes/navigation.php');

$sql = "SELECT * FROM categories WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$cat = $result->fetch(PDO::FETCH_ASSOC);
?>
<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Add New Category</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create a New Category Here...
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
                            <form role="form" method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <div class="form-group">
                                    <label>Category Title</label>
                                    <input class="form-control" name="title" placeholder="Enter Article Title" value="<?php if(isset($cat['title'])){ echo $cat['title'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Category Description</label>
                                    <textarea class="form-control" name="description" rows="3"><?php if(isset($cat['description'])){ echo $cat['description'];} ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Category Slug</label>
                                    <input class="form-control" name="slug" placeholder="Enter Category Slug Here" value="<?php if(isset($cat['slug'])){ echo $cat['slug'];} ?>">
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