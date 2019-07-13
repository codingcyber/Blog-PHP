<?php 
include('includes/check-login.php');
require_once('../includes/connect.php');
include('includes/header.php'); 
include('includes/navigation.php');  
?>
<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Widgets</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All the Widgets 
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Title</th>
                                    <th>Type</th>
                                    <th>Order</th>
                                    <th>Date</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM widget";
                                    $result = $db->prepare($sql);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $widget) {
                                ?>
                                <tr>
                                    <td><?php echo $widget['id']; ?></td>
                                    <td><?php echo $widget['title']; ?></td>
                                    <td><?php echo $widget['type']; ?></td>
                                    <td><?php echo $widget['widget_order']; ?></td>
                                    <td><?php echo $widget['updated']; ?></td>
                                    <td><a href="edit-widget.php?id=<?php echo $widget['id']; ?>">Edit</a> | <a href="delete-item.php?id=<?php echo $widget['id']; ?>&item=widget">Delete</a></td>
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