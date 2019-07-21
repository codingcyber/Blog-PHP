<?php 
session_start();
require_once('includes/connect.php');
include('includes/header.php');
include('comment.php');
include('includes/navigation.php'); 
$sql = "SELECT * FROM posts WHERE slug=? AND status='published'";
$result = $db->prepare($sql);
$result->execute(array($_GET['url']));
$post = $result->fetch(PDO::FETCH_ASSOC);

$usersql = "SELECT * FROM users WHERE id=?";
$userresult = $db->prepare($usersql);
$userresult->execute(array($post['uid']));
$user = $userresult->fetch(PDO::FETCH_ASSOC);
?>
<!-- Page Content -->
<div class="container">

  <div class="row">

    <!-- Post Content Column -->
    <div class="col-lg-8">

      <!-- Title -->
      <h1 class="mt-4"><?php echo $post['title']; ?></h1>

      <!-- Author -->
      <p class="lead">
        by
        <a href="http://localhost/Blog-PHP/user/<?php echo $user['username']; ?>"><?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?></a>
      <?php
        $sql = "SELECT * FROM comments WHERE pid=? AND status='approved'";
        $result = $db->prepare($sql);
        $result->execute(array($post['id']));
        $commentcount = $result->rowCount();
        if($commentcount >= 1){
      ?>
      <a href="#" class="btn btn-primary"><?php echo $commentcount; ?> Comments</a>
      <?php } ?>
      </p>
      <hr>

      <!-- Date/Time -->
      <p>Posted on <?php echo $post['created']; ?></p>

      <hr>

      <!-- Preview Image -->
      <?php if(isset($post['pic']) & !empty($post['pic'])){ ?>
          <img class="img-fluid rounded" src="http://localhost/Blog-PHP/<?php echo $post['pic']; ?>" alt="">
      <?php }else{ ?>
          <img class="img-fluid rounded" src="http://placehold.it/900x300" alt="">
      <?php } ?>
      <hr>

      <!-- Post Content -->
      <div class="content">
        <?php echo $post['content']; ?>
      </div>

      <hr>
      <?php
          $comsql = "SELECT * FROM settings WHERE name='comments'";
          $comresult = $db->prepare($comsql);
          $comresult->execute();
          $com = $comresult->fetch(PDO::FETCH_ASSOC);
      ?>
      <?php if($com['value'] == 'yes'){ 
            if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
              // Create CSRF token
              $token = md5(uniqid(rand(), TRUE));
              $_SESSION['csrf_token'] = $token;
              $_SESSION['csrf_token_time'] = time();
        ?>
      <!-- Comments Form -->
      <div class="card my-4">
        <h5 class="card-header">Leave a Comment:</h5>
        <div class="card-body">
          <?php
              if(!empty($messages)){
                  echo "<div class='alert alert-success'>";
                  foreach ($messages as $message) {
                      echo "<span class='glyphicon glyphicon-ok'></span>&nbsp;". $message ."<br>";
                  }
                  echo "</div>";
              }
          ?>
          <?php
              if(!empty($errors)){
                  echo "<div class='alert alert-danger'>";
                  foreach ($errors as $error) {
                      echo "<span class='glyphicon glyphicon-remove'></span>&nbsp;". $error ."<br>";
                  }
                  echo "</div>";
              }
          ?>
          <form method="post">
            <div class="form-group">
              <input type="hidden" name="uid" value="<?php echo $_SESSION['id']; ?>">
              <input type="hidden" name="pid" value="<?php echo $post['id']; ?>">
              <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
              <textarea class="form-control" name="comment" rows="3" required=""></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
          </form>
        </div>
      </div>
      <?php }else{ echo "<h3>You Should be LoggedIn to Post Comments.</h3><hr>"; }
            }else{ echo "<h3>Comments are Disabled.</h3><hr>"; } ?>
      <?php
          $sql = "SELECT comments.comment, users.username, users.fname, users.lname, users.role FROM comments INNER JOIN users ON comments.uid=users.id WHERE comments.pid=? AND comments.status='approved' ORDER BY comments.created DESC";
          $result = $db->prepare($sql);
          $result->execute(array($post['id'])) or die(print_r($result->errorInfo(), true));
          $comments = $result->fetchAll(PDO::FETCH_ASSOC);
          foreach($comments as $comment){
      ?>
      <!-- Single Comment -->
      <div class="media mb-4">
        <img class="d-flex mr-3 rounded-circle" src="http://placehold.it/50x50" alt="">
        <div class="media-body">
          <h5 class="mt-0">
              <?php if((isset($comment['fname']) || isset($comment['lname'])) & (!empty($comment['fname']) || !empty($comment['lname']))) { echo $comment['fname'] . " " . $comment['lname']; }else{ echo $comment['username']; } ?> 
              <?php if(($comment['role'] == 'administrator')){ echo "<span class='badge badge-danger'>Admin</span>"; }elseif(($comment['role'] == 'editor')){ echo "<span class='badge badge-primary'>Editor</span>"; } ?>
            </h5>
          <?php echo $comment['comment']; ?>
        </div>
      </div>
      <?php } ?>

    </div>

    <?php include('includes/sidebar.php'); ?>

  </div>
  <!-- /.row -->

</div>
<!-- /.container -->
<?php include('includes/footer.php'); ?>