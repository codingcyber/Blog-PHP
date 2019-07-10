<?php 
include('includes/check-login.php');
require_once('../includes/connect.php');
include('includes/header.php'); 
include('includes/navigation.php');  
?>
<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Articles</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All the Articles 
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Author</th>
                                    <th>Categories</th>
                                    <th>Image</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM posts";
                                    $result = $db->prepare($sql);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $post) {
                                    // TODO : Only user with administrator privillages or user who created the article can only edit or delete post

                                    // TODO : Display Categories with post_categories table data based on id

                                    // TODO : Display Image Status - Yes or No
                                ?>
                                <tr>
                                    <td><?php echo $post['id']; ?></td>
                                    <td><?php echo $post['title']; ?></td>
                                    <td><?php echo $post['uid']; ?></td>
                                    <td>Cat1, Cat2, Cat3</td>
                                    <td>Yes/No</td>
                                    <td><?php echo $post['updated']; ?></td>
                                    <td><?php echo $post['status']; ?></td>
                                    <td><a href="edit-article.php?id=<?php echo $post['id']; ?>">Edit</a> | <a href="delete-item.php?id=<?php echo $post['id']; ?>&item=article">Delete</a></td>
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