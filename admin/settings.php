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
                                    <label>Site Title</label>
                                    <input class="form-control" name="sitetitle" placeholder="Enter Site Title">
                                </div>
                                <div class="form-group">
                                    <label>Tagline</label>
                                    <input type="email" name="tagline" class="form-control" placeholder="Enter Tagline">
                                </div>
                                <div class="form-group">
                                    <label>Site Email Address</label>
                                    <input type="email" class="form-control" name="email" placeholder="Enter E-Mail">
                                </div>
                                <div class="form-group">
                                    <label>User Registration</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="userreg" id="optionsRadiosInline1" value="yes" checked="">Yes 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="userreg" id="optionsRadiosInline2" value="no">No
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Results Per Page</label>
                                    <input class="form-control" name="resultsperpage" placeholder="Enter Results Per Page">
                                </div>
                                <div class="form-group">
                                    <label>Comments</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="comments" id="optionsRadiosInline1" value="yes" checked="">Enable 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="comments" id="optionsRadiosInline2" value="no">Disable
                                    </label>
                                </div>
                                <div class="form-group">
                                    <label>Clean URL's</label>
                                    <label class="radio-inline">
                                        <input type="radio" name="cleanurls" id="optionsRadiosInline1" value="yes" checked="">Enable 
                                    </label>
                                    <label class="radio-inline">
                                        <input type="radio" name="cleanurls" id="optionsRadiosInline2" value="no">Disable
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