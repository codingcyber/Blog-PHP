<?php 
include('includes/check-login.php');
require_once('../includes/connect.php'); 
include('includes/header.php');
include('includes/navigation.php'); 
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
                    <div class="row">
                        <div class="col-lg-6">
                            <form role="form" method="post">
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
                                    <input type="email" name="tagline" class="form-control" placeholder="Enter Tagline" value="<?php echo $tag['value']; ?>">
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
                                    <input class="form-control" name="resultsperpage" placeholder="Enter Results Per Page" value="<?php echo $rpp['value']; ?>">
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