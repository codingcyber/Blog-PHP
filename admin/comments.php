<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/check-subscriber.php');
include('includes/header.php');
include('includes/navigation.php'); 
 ?>
<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Comments</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    View all the Comments here...
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Author</th>
                                    <th>Comment</th>
                                    <th>In Response To</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT comments.id, comments.comment, comments.status, comments.created, users.username, posts.title FROM comments INNER JOIN users ON comments.uid=users.id INNER JOIN posts ON comments.pid=posts.id";
                                    $result = $db->prepare($sql);
                                    $result->execute() or die(print_r($result->errorInfo(), true));
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach($res as $comment){
                                ?>
                                <tr>
                                    <td><?php echo $comment['id']; ?></td>
                                    <td><?php echo $comment['username']; ?></td>
                                    <td><?php echo $comment['comment']; ?></td>
                                    <td><?php echo $comment['title']; ?></td>
                                    <td><?php echo $comment['created']; ?></td>
                                    <td><?php echo $comment['status']; ?></td>
                                    <?php
                                    $sql = "SELECT * FROM users WHERE id=?";
                                    $result = $db->prepare($sql);
                                    $result->execute(array($_SESSION['id']));
                                    $user = $result->fetch(PDO::FETCH_ASSOC); 

                                    if($user['role'] == 'administrator'){
                                    ?>
                                    <td><a href="edit-comment.php?id=<?php echo $comment['id']; ?>">Edit</a> | <?php 
                                        if($comment['status'] == 'approved'){
                                            echo "<a href='commentstatus.php?id=".$comment['id']."&status=disapproved'>Disapprove</a>";
                                        }else{
                                            echo "<a href='commentstatus.php?id=".$comment['id']."&status=approved'>Approve</a>";
                                        }
                                     ?></td>
                                    <?php }else{ echo "<td>NA</td>"; } ?>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <!-- /.table-responsive -->
                </div>
                <!-- /.panel-body -->
            </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
</div>
<?php include('includes/footer.php'); ?>