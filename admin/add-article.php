<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-subscriber.php'); 
if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['title'])){$errors[] = "Title Field is Required";}
    if(empty($_POST['content'])){$errors[] = "Content Field is Required";}
    if(empty($_POST['slug'])){$slug = trim($_POST['title']); }else{$slug = trim($_POST['slug']);}
    if(empty($_FILES['pic']['name'])){$errors[] = "You Should Upload a File";}
    // check slug is unique with db query
    $search = array(" ", ",", ".", "_");
    $slug = strtolower(str_replace($search, '-', $slug));
    $sql = "SELECT * FROM posts WHERE slug=?";
    $result = $db->prepare($sql);
    $result->execute(array($slug));
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
        if(isset($_FILES) & !empty($_FILES)){
            $name = $_FILES['pic']['name'];
            $size = $_FILES['pic']['size'];
            $type = $_FILES['pic']['type'];
            $tmp_name = $_FILES['pic']['tmp_name'];

            if(isset($name) && !empty($name)){
                if($type == "image/jpeg"){
                    $location = "../media/";
                    $filename = time() . $name;
                    $uploadpath = $location.$filename;
                    $dbpath = "media/" . $filename;
                    move_uploaded_file($tmp_name, $uploadpath);
                }else{
                    $errors[] = "Only Upload JPEG files";
                }
            }
        }

        $sql = "INSERT INTO posts (uid, title, content, status, slug, pic) VALUES (:uid, :title, :content, :status, :slug, :pic)";
        $result = $db->prepare($sql);
        $values = array(':uid'      => $_SESSION['id'],
                        ':title'    => $_POST['title'],
                        ':content'  => $_POST['content'],
                        ':status'   => $_POST['status'],
                        ':slug'     => $slug,
                        ':pic'      => $dbpath
                        );
        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
        if($res){
            // After inserting the article, insert category id and article id into post_categories table
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
            $errors[] = "Failed to Add Article";
        }
    }
}
// Create CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();

include('includes/header.php');
include('includes/navigation.php'); 
?>
<script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/5/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea'});</script>
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
                                <div class="form-group">
                                    <label>Article Title</label>
                                    <input class="form-control" name="title" placeholder="Enter Article Title" value="<?php if(isset($_POST['title'])){ echo $_POST['title'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Article Content</label>
                                    <textarea class="form-control" name="content" rows="3"><?php if(isset($_POST['content'])){ echo $_POST['content'];} ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Featured Image</label>
                                    <input type="file" name="pic">
                                </div>

                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <?php 
                                            // Fetch categories from categories table
                                            $sql = "SELECT * FROM categories";
                                            $result = $db->prepare($sql);
                                            $result->execute();
                                            $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                            ?>
                                            <label>Categories</label>
                                            <select multiple="" name="categories[]" class="form-control">
                                                <?php
                                                    foreach ($res as $cat) {
                                                        if(in_array($cat['id'], $_POST['categories'])){ $checked = "selected"; }else{ $checked = ""; }
                                                        echo "<option value='".$cat['id']."'".$checked .">".$cat['title']."</option>";
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label>Article Status</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios1" value="draft" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['status'] == 'draft'){ echo "checked"; } } ?>>Draft
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios2" value="review" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['status'] == 'review'){ echo "checked"; } } ?>>Pending Review
                                                </label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="status" id="optionsRadios3" value="published" <?php if(isset($_POST) & !empty($_POST)){ if($_POST['status'] == 'published'){ echo "checked"; } } ?>>Published
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Article Slug</label>
                                    <input class="form-control" name="slug" placeholder="Enter Article Slug Here" value="<?php if(isset($_POST['slug'])){ echo $_POST['slug'];} ?>">
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