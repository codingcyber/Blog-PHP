<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-subscriber.php');
include('includes/header.php');
include('includes/navigation.php');  
?>
<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-comments fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <?php 
                                $sql = "SELECT * FROM comments";
                                $result = $db->prepare($sql);
                                $result->execute();
                                $comments = $result->fetchAll(PDO::FETCH_ASSOC); 
                                $commentscount = $result->rowCount();
                             ?>
                            <div class="huge"><?php echo $commentscount; ?></div>
                            <div>Total Comments!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"><a href="comments.php">View Comments</a></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <?php 
                                $sql = "SELECT * FROM posts WHERE status='published'";
                                $result = $db->prepare($sql);
                                $result->execute(); 
                                $publishedcount = $result->rowCount();
                             ?>
                            <div class="huge"><?php echo $publishedcount; ?></div>
                            <div>Published Articles!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"><a href="view-articles.php">View Published Articles</a></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-4 col-md-4">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <?php 
                                $sql = "SELECT * FROM posts WHERE status='draft'";
                                $result = $db->prepare($sql);
                                $result->execute(); 
                                $draftcount = $result->rowCount();
                             ?>
                            <div class="huge"><?php echo $draftcount; ?></div>
                            <div>Draft Articles!</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left"><a href="view-articles.php">View Draft Articles</a></span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-8">
            <!-- /.panel -->
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bar-chart-o fa-fw"></i> Recent Articles
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $sql = "SELECT * FROM posts";
                                            $result = $db->prepare($sql);
                                            $result->execute(); 
                                            $posts = $result->fetchAll(PDO::FETCH_ASSOC);
                                            foreach ($posts as $post) {
                                                $usersql = "SELECT * FROM users WHERE id=?";
                                                $userresult = $db->prepare($usersql);
                                                $userresult->execute(array($post['uid']));
                                                $user = $userresult->fetch(PDO::FETCH_ASSOC);
                                         ?>
                                        <tr>
                                            <td><?php echo $post['id']; ?></td>
                                            <td><?php echo $post['title']; ?></td>
                                            <td><?php echo $user['username']; ?></td>
                                            <td><?php echo $post['status']; ?></td>
                                        </tr>
                                    <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.col-lg-4 (nested) -->
                    </div>
                    <!-- /.row -->
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-8 -->
        <div class="col-lg-4">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class="fa fa-bell fa-fw"></i> Recent Comments
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="list-group">
                        <?php 
                            foreach ($comments as $comment) {
                         ?>
                        <a href="#" class="list-group-item">
                            <i class="fa fa-comment fa-fw"></i> <?php echo substr($comment['comment'],0,10); ?>
                            <span class="pull-right text-muted small"><em><?php echo $comment['created']; ?></em>
                            </span>
                        </a>
                    <?php } ?>
                    </div>
                    <!-- /.list-group -->
                    <a href="comments.php" class="btn btn-default btn-block">View All Comments</a>
                </div>
                <!-- /.panel-body -->
            </div>
            <!-- /.panel -->
            
        </div>
        <!-- /.col-lg-4 -->
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->
<?php include('includes/footer.php'); ?>
