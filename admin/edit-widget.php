<?php 
require_once('../includes/connect.php');
include('includes/check-login.php'); 
include('includes/check-admin.php');
include('includes/check-subscriber.php');
if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['title'])){$errors[] = "Title Field is Required";}
    if(empty($_POST['type'])){$errors[] = "Widget Type Field is Required";}
    if(empty($_POST['content'])){$errors[] = "Widget Content Field is Required";}
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
        $sql = "UPDATE widget SET title=:title, content=:content, type=:type, widget_order=:widgetorder, updated=NOW() WHERE id=:id";
        $result = $db->prepare($sql);
        $values = array(':title'        => $_POST['title'],
                        ':content'      =>  $_POST['content'],
                        ':type'         => $_POST['type'],
                        ':widgetorder'  => $_POST['order'],
                        ':id'           => $_POST['id']
                        );
        $res = $result->execute($values) or die(print_r($result->errorInfo(), true));
        if($res){
            header("location: view-widgets.php");
        }else{
            $errors[] = "Failed to Add Widget";
        }
    }
}
// Create CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();

include('includes/header.php');
include('includes/navigation.php'); 
$sql = "SELECT * FROM widget WHERE id=?";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$widget = $result->fetch(PDO::FETCH_ASSOC);
?>
<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Edit Widget</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Update Widget Here...
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
                                    <label>Widget Title</label>
                                    <input class="form-control" name="title" placeholder="Enter Article Title" value="<?php if(isset($widget['title'])){ echo $widget['title'];} ?>">
                                </div>
                                <div class="form-group">
                                    <label>Widget Type</label>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" id="optionsRadios1" value="html" <?php if($widget['type'] == 'html'){ echo "checked"; } ?>>HTML
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" id="optionsRadios2" value="categories" <?php if($widget['type'] == 'categories'){ echo "checked"; } ?>>Categories
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" id="optionsRadios3" value="search" <?php if($widget['type'] == 'search'){ echo "checked"; } ?>>Search
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" id="optionsRadios3" value="articles" <?php if($widget['type'] == 'articles'){ echo "checked"; } ?>>Recent Articles
                                        </label>
                                    </div>
                                    <div class="radio">
                                        <label>
                                            <input type="radio" name="type" id="optionsRadios3" value="pages" <?php if($widget['type'] == 'pages'){ echo "checked"; } ?>>Pages
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label>Widget Content</label>
                                    <textarea class="form-control" name="content" rows="3"><?php if(isset($widget['content'])){ echo $widget['content'];} ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Widget Order</label>
                                    <select class="form-control" name="order">
                                        <?php
                                            for ($i=1; $i < 10; $i++) {
                                                if($widget['widget_order'] == $i){ $checked = "selected"; }else{ $checked = ""; } 
                                                echo "<option value='$i' $checked>$i</option>";
                                            }
                                        ?>
                                    </select>
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