<?php
session_start(); 
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php');
$sql = "SELECT * FROM post_categories WHERE cid=? ORDER BY created DESC";
$result = $db->prepare($sql);
$result->execute(array($_GET['id']));
$postcount = $result->rowCount();
$postids = $result->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <?php
          $catsql = "SELECT * FROM categories WHERE id=?";
          $catresult = $db->prepare($catsql);
          $catresult->execute(array($_GET['id']));
          $catres = $catresult->fetch(PDO::FETCH_ASSOC);
      ?>
      <h1 class="my-4">Category : <?php echo $catres['title']; ?></h1>
      
      <?php
        if($postcount >= 1){
          foreach ($postids as $postid) {
            $postsql = "SELECT * FROM posts WHERE id=?";
            $postresult = $db->prepare($postsql);
            $postresult->execute(array($postid['id']));
            $posts = $postresult->fetchAll(PDO::FETCH_ASSOC);
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
          Posted on <?php echo $post['created']; ?> by
          <?php
            $usersql = "SELECT * FROM users WHERE id=?";
            $userresult = $db->prepare($usersql);
            $userresult->execute(array($post['uid']));
            $user = $userresult->fetch(PDO::FETCH_ASSOC);
          ?>
          <a href="user-posts.php?id=<?php echo $user['id']; ?>"><?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        </div>
      </div>
    <?php } } }else{
      echo "<h3>No Articles for this category</h3>";
    } ?>

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

    <!-- Sidebar Widgets Column -->
    <div class="col-md-4">

      <!-- Search Widget -->
      <div class="card my-4">
        <h5 class="card-header">Search</h5>
        <div class="card-body">
          <div class="input-group">
            <input type="text" class="form-control" placeholder="Search for...">
            <span class="input-group-btn">
              <button class="btn btn-secondary" type="button">Go!</button>
            </span>
          </div>
        </div>
      </div>

      <!-- Categories Widget -->
      <div class="card my-4">
        <h5 class="card-header">Categories</h5>
        <div class="card-body">
          <div class="row">
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="#">Web Design</a>
                </li>
                <li>
                  <a href="#">HTML</a>
                </li>
                <li>
                  <a href="#">Freebies</a>
                </li>
              </ul>
            </div>
            <div class="col-lg-6">
              <ul class="list-unstyled mb-0">
                <li>
                  <a href="#">JavaScript</a>
                </li>
                <li>
                  <a href="#">CSS</a>
                </li>
                <li>
                  <a href="#">Tutorials</a>
                </li>
              </ul>
            </div>
          </div>
        </div>
      </div>

      <!-- Side Widget -->
      <div class="card my-4">
        <h5 class="card-header">Side Widget</h5>
        <div class="card-body">
          You can put anything you want inside of these side widgets. They are easy to use, and feature the new Bootstrap 4 card containers!
        </div>
      </div>

    </div>

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->
<?php include('includes/footer.php'); ?>