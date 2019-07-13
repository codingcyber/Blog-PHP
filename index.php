<?php 
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
            <a href="single.php?id=<?php echo $post['id']; ?>" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on <?php echo $post['created']; ?>
            <a href="#">Start Bootstrap</a>
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

