<?php 
include('includes/check-login.php');
require_once('../includes/connect.php'); 
if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['title'])){$errors[] = "Title Field is Required";}
    if(empty($_POST['content'])){$errors[] = "Content Field is Required";}
    if(empty($_POST['slug'])){$errors[] = "Slug Field is Required";}
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
        // TODO : Upload Article Image
        // TODO : Only user with Administrator privillages or user who created the article can only edit 
        $sql = "UPDATE posts SET title=:title, content=:content, status=:status, slug=:slug, updated=NOW() WHERE id=:id";
        $result = $db->prepare($sql);
        $values = array(':title'    => $_POST['title'],
                        ':content'  => $_POST['content'],
                        ':status'   => $_POST['status'],
                        ':slug'     => $_POST['slug'],
                        ':id'       => $_POST['id']
                        );
        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
        if($res){
            // TODO : check post id and category id in post_categories table, then only create or update records
            $pid = $db->lastInsertID();
            foreach ($_POST['categories'] as $category) {
            $sql = "INSERT INTO post_categories (pid, cid) VALUES (:pid, :cid)";
            $result = $db->prepare($sql);
            $values = array(':pid'  => $pid,
                            ':cid'  => $category
                            );
            $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
            }
            header("location: view-articles.php");
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

$sql = "SELECT * FROM posts WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$post = $result->fetch(PDO::FETCH_ASSOC);
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
                            <form role="form" method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
                                <div class="form-group">
                                    <label>Article Title</label>
                                    <input class="form-control" name="title" placeholder="Enter Article Title" value="<?php if(isset($post['title'])){ echo $post['title'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Article Content</label>
                                    <textarea class="form-control" name="content" rows="3"><?php if(isset($post['content'])){ echo $post['content'];} ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Featured Image</label>
                                    <input type="file" name="pic">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php 
                                                // TODO : Select Existing Categories from Database Values
                                            $sql = "SELECT * FROM categories";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <label>Categories</label>
                                            <select multiple="" name="categories[]" class="form-control">
                                                <?php
                                                    foreach ($res as $cat) {
                                                        echo "<option value='".$cat['id']."'>".$cat['title']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Article Status</label>
                                            <?php 
                                                // TODO : Select the Article Status After Failed Submission
                                            ?>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios1" value="draft" checked="">Draft
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios2" value="review">Pending Review
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios3" value="published">Published
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Article Slug</label>
                                    <input class="form-control" name="slug" placeholder="Enter Article Slug Here" value="<?php if(isset($post['slug'])){ echo $post['slug'];} ?>">
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