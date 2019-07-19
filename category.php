<?php
session_start(); 
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php');

// get number of per page results from settings table
$rppsql = "SELECT * FROM settings WHERE name='resultsperpage'";
$rppresult = $db->prepare($rppsql);
$rppresult->execute();
$rpp = $rppresult->fetch(PDO::FETCH_ASSOC);
$perpage = $rpp['value'];

if(isset($_GET['page']) & !empty($_GET['page'])){
  $curpage = $_GET['page'];
}else{
  $curpage = 1;
}
// get the number of total posts from posts table
$sql = "SELECT * FROM post_categories INNER JOIN posts ON post_categories.pid=posts.id INNER JOIN categories ON post_categories.cid=categories.id WHERE categories.slug=? AND posts.status='published'";
$result = $db->prepare($sql);
$result->execute(array($_GET['url']));
$totalres = $result->rowCount();
// create startpage, nextpage, endpage variables with values
$endpage = ceil($totalres/$perpage);
$startpage = 1;
$nextpage = $curpage + 1;
$previouspage = $curpage - 1;
$start = ($curpage * $perpage) - $perpage;

// fetch the results
$sql = "SELECT posts.title, posts.pic, posts.content, posts.slug, posts.id, posts.created, posts.uid FROM post_categories INNER JOIN posts ON post_categories.pid=posts.id INNER JOIN categories ON post_categories.cid=categories.id WHERE categories.slug=? AND posts.status='published' ORDER BY posts.created DESC LIMIT $start, $perpage";
$result = $db->prepare($sql);
$result->execute(array($_GET['url']));
$postcount = $result->rowCount();
$posts = $result->fetchAll(PDO::FETCH_ASSOC);
 ?>
<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Blog Entries Column -->
    <div class="col-md-8">
      <?php
          $catsql = "SELECT * FROM categories WHERE slug=?";
          $catresult = $db->prepare($catsql);
          $catresult->execute(array($_GET['url']));
          $catres = $catresult->fetch(PDO::FETCH_ASSOC);
      ?>
      <h1 class="my-4">Category : <?php echo $catres['title']; ?></h1>
      
      <?php
        if($postcount >= 1){
          // foreach ($postids as $postid) {
          //   $postsql = "SELECT * FROM posts WHERE id=?";
          //   $postresult = $db->prepare($postsql);
          //   $postresult->execute(array($postid['id']));
          //   $posts = $postresult->fetchAll(PDO::FETCH_ASSOC);
            foreach ($posts as $post) {
      ?>
      <!-- Blog Post -->
      <div class="card mb-4">
        <?php if(isset($post['pic']) & !empty($post['pic'])){ ?>
            <img class="card-img-top" src="http://localhost/Blog-PHP/<?php echo $post['pic']; ?>" alt="Card image cap">
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
          <a href="http://localhost/Blog-PHP/<?php echo $post['slug']; ?>" class="btn btn-primary">Read More &rarr;</a>
        </div>
        <div class="card-footer text-muted">
          Posted on <?php echo $post['created']; ?> by
          <?php
            $usersql = "SELECT * FROM users WHERE id=?";
            $userresult = $db->prepare($usersql);
            $userresult->execute(array($post['uid']));
            $user = $userresult->fetch(PDO::FETCH_ASSOC);
          ?>
          <a href="http://localhost/Blog-PHP/user/<?php echo $user['username']; ?>"><?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
        </div>
      </div>
    <?php //} 
      } }else{
      echo "<h3>No Articles for this category</h3>";
    } ?>

    <!-- Pagination -->
      <ul class="pagination justify-content-center mb-4">
        <?php if($curpage != $startpage){ ?>
        <li class="page-item">
          <a class="page-link" href="http://localhost/Blog-PHP/category/<?php echo $_GET['url']; ?>/<?php echo $startpage; ?>">&larr; Older</a>
        </li>
        <?php } ?>
        <?php if($curpage >= 2){ ?>
        <li class="page-item">
          <a class="page-link" href="http://localhost/Blog-PHP/category/<?php echo $_GET['url']; ?>/<?php echo $previouspage; ?>"><?php echo $previouspage; ?></a>
        </li>
        <?php } ?>
        <?php if($curpage != $endpage ){ ?>
        <li class="page-item">
          <a class="page-link" href="http://localhost/Blog-PHP/category/<?php echo $_GET['url']; ?>/<?php echo $nextpage; ?>"><?php echo $nextpage; ?></a>
        </li>
        <?php } ?>
        <?php if($curpage != $endpage){ ?>
        <li class="page-item">
          <a class="page-link" href="http://localhost/Blog-PHP/category/<?php echo $_GET['url']; ?>/<?php echo $endpage; ?>">Newer &rarr;</a>
        </li>
        <?php } ?>
      </ul>

    </div>

    <?php include('includes/sidebar.php'); ?>

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->
<?php include('includes/footer.php'); ?>