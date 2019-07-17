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
            <h1 class="page-header">Categories</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All the Categories 
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Updated</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    $sql = "SELECT * FROM categories";
                                    $result = $db->prepare($sql);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $cat) {
                                ?>
                                <tr>
                                    <td><?php echo $cat['id']; ?></td>
                                    <td><?php echo $cat['title']; ?></td>
                                    <td><?php echo $cat['slug']; ?></td>
                                    <td><?php echo $cat['updated']; ?></td>
                                    <td><a href="edit-category.php?id=<?php echo $cat['id']; ?>">Edit</a> | <a href="delete-item.php?id=<?php echo $cat['id']; ?>&item=category">Delete</a></td>
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