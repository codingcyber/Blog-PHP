<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-admin.php');
include('includes/check-subscriber.php'); 
include('includes/header.php');
include('includes/navigation.php'); 
if(isset($_POST) & !empty($_POST)){
    // PHP Form Validations
    if(empty($_POST['sitetitle'])){$errors[] = "Site Title Field is Required";}
    if(empty($_POST['tagline'])){$errors[] = "Tag Line Field is Required";}
    if(empty($_POST['email'])){$errors[] = "E-Mail Field is Required";}
    if(empty($_POST['userreg'])){$errors[] = "User Registration Field is Required";}
    if(empty($_POST['resultsperpage'])){$errors[] = "Results Per Page Field is Required";}
    if(empty($_POST['comments'])){$errors[] = "Comments Field is Required";}
    if(empty($_POST['cleanurls'])){$errors[] = "Clean URLs Field is Required";}
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
        $titlesql = "UPDATE settings SET value=?, updated=NOW() WHERE name='sitetitle'";
        $titleresult = $db->prepare($titlesql);
        $titleresult->execute(array($_POST['sitetitle']));

        $tagsql = "UPDATE settings SET value=?, updated=NOW() WHERE name='tagline'";
        $tagresult = $db->prepare($tagsql);
        $tagresult->execute(array($_POST['tagline']));

        $emailsql = "UPDATE settings SET value=?, updated=NOW() WHERE name='email'";
        $emailresult = $db->prepare($emailsql);
        $emailresult->execute(array($_POST['email']));

        $userregsql = "UPDATE settings SET value=?, updated=NOW() WHERE name='userreg'";
        $userregresult = $db->prepare($userregsql);
        $userregresult->execute(array($_POST['userreg']));

        $rppsql = "UPDATE settings SET value=?, updated=NOW() WHERE name='resultsperpage'";
        $rppresult = $db->prepare($rppsql);
        $rppresult->execute(array($_POST['resultsperpage']));

        $comsql = "UPDATE settings SET value=?, updated=NOW() WHERE name='comments'";
        $comresult = $db->prepare($comsql);
        $comresult->execute(array($_POST['comments']));

        $urlsql = "UPDATE settings SET value=?, updated=NOW() WHERE name='cleanurls'";
        $urlresult = $db->prepare($urlsql);
        $urlresult->execute(array($_POST['cleanurls']));
    }
}
// Create CSRF token
$token = md5(uniqid(rand(), TRUE));
$_SESSION['csrf_token'] = $token;
$_SESSION['csrf_token_time'] = time();
?>
<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Setttings</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    CMS Settings Here...
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
                        <div class="col-lg-6">
                            <form role="form" method="post">
                                <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
                                <div class="form-group">
                                    <?php
                                        $titlesql = "SELECT * FROM settings WHERE name='sitetitle'";
                                        $titleresult = $db->prepare($titlesql);
                                        $titleresult->execute();
                                        $title = $titleresult->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <label>Site Title</label>
                                    <input class="form-control" name="sitetitle" placeholder="Enter Site Title" value="<?php echo $title['value']; ?>">
                                </div>
                                <div class="form-group">
                                    <?php
                                        $tagsql = "SELECT * FROM settings WHERE name='tagline'";
                                        $tagresult = $db->prepare($tagsql);
                                        $tagresult->execute();
                                        $tag = $tagresult->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <label>Tagline</label>
                                    <input name="tagline" class="form-control" placeholder="Enter Tagline" value="<?php echo $tag['value']; ?>">
                                </div>
                                <div class="form-group">
                                    <?php
                                        $emailsql = "SELECT * FROM settings WHERE name='email'";
                                        $emailresult = $db->prepare($emailsql);
                                        $emailresult->execute();
                                        $email = $emailresult->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <label>Site Email Address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter E-Mail" value="<?php echo $email['value']; ?>">
                                </div>
                                <div class="form-group">
                                    <?php
                                        $userregsql = "SELECT * FROM settings WHERE name='userreg'";
                                        $userregresult = $db->prepare($userregsql);
                                        $userregresult->execute();
                                        $userreg = $userregresult->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <label>User Registration</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="userreg" id="optionsRadiosInline1" value="yes" <?php if($userreg['value'] == 'yes'){ echo "checked"; } ?>>Yes 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="userreg" id="optionsRadiosInline2" value="no" <?php if($userreg['value'] == 'no'){ echo "checked"; } ?>>No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <?php
                                        $rppsql = "SELECT * FROM settings WHERE name='resultsperpage'";
                                        $rppresult = $db->prepare($rppsql);
                                        $rppresult->execute();
                                        $rpp = $rppresult->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <label>Results Per Page</label>
                                    <input type="number" class="form-control" name="resultsperpage" placeholder="Enter Results Per Page" value="<?php echo $rpp['value']; ?>">
                                </div>
                                <div class="form-group">
                                    <?php
                                        $comsql = "SELECT * FROM settings WHERE name='comments'";
                                        $comresult = $db->prepare($comsql);
                                        $comresult->execute();
                                        $com = $comresult->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <label>Comments</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="comments" id="optionsRadiosInline1" value="yes" <?php if($com['value'] == 'yes'){ echo "checked"; } ?>>Enable 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="comments" id="optionsRadiosInline2" value="no" <?php if($com['value'] == 'no'){ echo "checked"; } ?>>Disable
                                    </label>
                                </div>
                                <div class="form-group">
                                    <?php
                                        $urlsql = "SELECT * FROM settings WHERE name='cleanurls'";
                                        $urlresult = $db->prepare($urlsql);
                                        $urlresult->execute();
                                        $url = $urlresult->fetch(PDO::FETCH_ASSOC);
                                    ?>
                                    <label>Clean URL's</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="cleanurls" id="optionsRadiosInline1" value="yes" <?php if($url['value'] == 'yes'){ echo "checked"; } ?>>Enable 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="cleanurls" id="optionsRadiosInline2" value="no" <?php if($url['value'] == 'no'){ echo "checked"; } ?>>Disable
                                    </label>
                                </div>

                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-danger">Reset </button>
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