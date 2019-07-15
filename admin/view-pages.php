<?php 
require_once('../includes/connect.php');
include('includes/check-login.php');
include('includes/header.php'); 
include('includes/navigation.php');  
?>
<div id="page-wrapper" style="min-height: 345px;">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Pages</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    All the Pages 
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Page Title</th>
                                    <th>Author</th>
                                    <th>Order</th>
                                    <th>Slug</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                    <th>Operations</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    $sql = "SELECT * FROM pages";
                                    $result = $db->prepare($sql);
                                    $result->execute();
                                    $res = $result->fetchAll(PDO::FETCH_ASSOC);
                                    foreach ($res as $page) {
                                    // TODO : Only user with administrator privillages or user who created the page can only edit or delete post

                                        $usersql = "SELECT * FROM users WHERE id=?";
                                        $userresult = $db->prepare($usersql);
                                        $userresult->execute(array($page['uid']));
                                        $user = $userresult->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <tr>
                                    <td><?php echo $page['id']; ?></td>
                                    <td><?php echo $page['title']; ?></td>
                                    <td><a href="edit-user.php?id=<?php echo $user['id']; ?>"><?php echo $user['username']; ?></a></td>
                                    <td><?php echo $page['page_order']; ?></td>
                                    <td><?php echo $page['slug']; ?></td>
                                    <td><?php echo $page['updated']; ?></td>
                                    <td><?php echo $page['status']; ?></td>
                                    <td><a href="edit-page.php?id=<?php echo $page['id']; ?>">Edit</a> | <a href="delete-item.php?id=<?php echo $page['id']; ?>&item=page">Delete</a></td>
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