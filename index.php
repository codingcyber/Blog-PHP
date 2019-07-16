<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 
$sql = "SELECT * FROM posts";
$result = $db->prepare($sql);
$result->execute();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);
?>
<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">

      <h1 class="my-4">Blog Home</h1>
      <?php
        foreach ($posts as $post) {
      ?>
        <!-- Blog Post -->
        <div class="card mb-4">
          <?php if(isset($post['pic']) & !empty($post['pic'])){ ?>
              <img class="card-img-top" src="<?php echo $post['pic']; ?>" alt="Card image cap">
          <?php }else{ ?>
              <img class="card-img-top" src="http://placehold.it/750x300" alt="Card image cap">
          <?php } ?>
          <div class="card-body">
            <h2 class="card-title"><?php echo $post['title']; ?></h2>
            <p class="card-text"><?php echo $post['content']; ?></p>
            <?php
              $sql = "SELECT * FROM comments WHERE pid=? AND status='approved'";
              $result = $db->prepare($sql);
              $result->execute(array($post['id']));
              $commentcount = $result->rowCount();
              if($commentcount >= 1){
            ?>
            <a href="#" class="btn btn-secondary"><?php echo $commentcount; ?> Comments</a>
            <?php } ?>
            <a href="single.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on <?php echo $post['created']; ?>
            <?php
            $usersql = "SELECT * FROM users WHERE id=?";
            $userresult = $db->prepare($usersql);
            $userresult->execute(array($post['uid']));
            $user = $userresult->fetch(PDO::FETCH_ASSOC);
          ?>
          <a href="user-posts.php?id=<?php echo $user['id']; ?>"><?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
          </div>
        </div>
      <?php } ?>

      <!-- Pagination -->
      <ul class="pagination justify-content-center mb-4">
        <li class="page-item">
          <a class="page-link" href="#">&larr; Older</a>
        </li>
        <li class="page-item disabled">
          <a class="page-link" href="#">Newer &rarr;</a>
        </li>
      </ul>

    </div>

    <?php include('includes/sidebar.php'); ?>

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->
<?php include('includes/footer.php'); ?>

