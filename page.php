<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('includes/navigation.php'); 
$sql = "SELECT * FROM pages WHERE slug=? AND status='published'";
$result = $db->prepare($sql);
$result->execute(array($_GET['url']));
$page = $result->fetch(PDO::FETCH_ASSOC);

$usersql = "SELECT * FROM users WHERE id=?";
$userresult = $db->prepare($usersql);
$userresult->execute(array($page['uid']));
$user = $userresult->fetch(PDO::FETCH_ASSOC);
?>
<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-8">

      <!-- Title -->
      <h1 class="mt-4"><?php echo $page['title']; ?></h1>

      <!-- Author -->
      <p class="lead">
        by
        <a href="http://localhost/Blog-PHP/user/<?php echo $user['username']; ?>"><?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
      </p>

      <hr>

      <!-- Date/Time -->
      <p>Posted on <?php echo $page['created']; ?></p>

      <hr>

      <!-- Preview Image -->
      <?php if(isset($page['pic']) & !empty($page['pic'])){ ?>
          <img class="img-fluid rounded" src="http://localhost/Blog-PHP/<?php echo $page['pic']; ?>" alt="">
      <?php }else{ ?>
          <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
      <?php } ?>
      <hr>

      <!-- Post Content -->
      <div class="content">
        <?php echo $page['content']; ?>
      </div>

      <hr>

    </div>

    <?php include('includes/sidebar.php'); ?>

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->
<?php include('includes/footer.php'); ?>