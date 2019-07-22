<!-- Sidebar Widgets Column -->
<div class="col-md-4">
<?php
$searchsql = "SELECT * FROM widget WHERE type='search'";
$searchresult = $db->prepare($searchsql);
$searchresult->execute();
$widgetcount = $searchresult->rowCount();
if($widgetcount == 1){
?>
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
<?php } ?>

<?php
$searchsql = "SELECT * FROM widget WHERE type='categories'";
$searchresult = $db->prepare($searchsql);
$searchresult->execute();
$widgetcount = $searchresult->rowCount();
if($widgetcount == 1){

  $catsql = "SELECT * FROM categories";
  $catresult = $db->prepare($catsql);
  $catresult->execute();
  $catres = $catresult->fetchAll(PDO::FETCH_ASSOC);
?>
  <!-- Categories Widget -->
  <div class="card my-4">
    <h5 class="card-header">Categories</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-unstyled mb-0">
            <?php foreach ($catres as $cat) { ?>
            <li>
              <a href="http://localhost/Blog-PHP/category/<?php echo $cat['title']; ?>"><?php echo $cat['title']; ?></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php
$searchsql = "SELECT * FROM widget WHERE type='articles'";
$searchresult = $db->prepare($searchsql);
$searchresult->execute();
$widgetcount = $searchresult->rowCount();
if($widgetcount == 1){

  $postsql = "SELECT * FROM posts WHERE status='published' LIMIT 5";
  $postresult = $db->prepare($postsql);
  $postresult->execute();
  $postres = $postresult->fetchAll(PDO::FETCH_ASSOC);
?>
  <!-- Categories Widget -->
  <div class="card my-4">
    <h5 class="card-header">Recent Articles</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-unstyled mb-0">
            <?php foreach ($postres as $post) { ?>
            <li>
              <a href="http://localhost/Blog-PHP/<?php echo $post['slug']; ?>"><?php echo $post['title']; ?></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php
$searchsql = "SELECT * FROM widget WHERE type='pages'";
$searchresult = $db->prepare($searchsql);
$searchresult->execute();
$widgetcount = $searchresult->rowCount();
if($widgetcount == 1){

  $pagesql = "SELECT * FROM pages WHERE status='published' LIMIT 5";
  $pageresult = $db->prepare($pagesql);
  $pageresult->execute();
  $pageres = $pageresult->fetchAll(PDO::FETCH_ASSOC);
?>
  <!-- Categories Widget -->
  <div class="card my-4">
    <h5 class="card-header">Pages</h5>
    <div class="card-body">
      <div class="row">
        <div class="col-lg-12">
          <ul class="list-unstyled mb-0">
            <?php foreach ($pageres as $page) { ?>
            <li>
              <a href="http://localhost/Blog-PHP/page/<?php echo $page['slug']; ?>"><?php echo $page['title']; ?></a>
            </li>
            <?php } ?>
          </ul>
        </div>
      </div>
    </div>
  </div>
<?php } ?>

<?php
$htmlwidsql = "SELECT * FROM widget WHERE type='html' ORDER BY widget_order";
$htmlwidresult = $db->prepare($htmlwidsql);
$htmlwidresult->execute();
$htmlres = $htmlwidresult->fetchAll(PDO::FETCH_ASSOC);
foreach ($htmlres as $htmlwidget) {
?>
  <!-- Side Widget -->
  <div class="card my-4">
    <h5 class="card-header"><?php echo $htmlwidget['title']; ?></h5>
    <div class="card-body">
      <?php echo $htmlwidget['content']; ?>
    </div>
  </div>
<?php } ?>

<?php
  if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
    // display logged in user details
    $sql = "SELECT * FROM users WHERE id=?";
    $result = $db->prepare($sql);
    $result->execute(array($_SESSION['id']));
    $user = $result->fetch(PDO::FETCH_ASSOC); 
?>
  <!-- Side Widget -->
  <div class="card my-4">
    <h5 class="card-header">User</h5>
    <div class="card-body">
      Hi <?php if((isset($user['fname']) || isset($user['lname'])) & (!empty($user['fname']) || !empty($user['lname']))) {echo $user['fname'] . " " . $user['lname']; }else{echo $user['username']; } ?>, 

      Logged in as 
      <?php 
        if(($user['role'] == 'administrator') || ($user['role'] == 'editor')){
          echo "<a href='http://localhost/Blog-PHP/admin/dashboard.php'".$user['role']."</a>";
        }elseif($user['role'] == 'subscriber'){
          echo "<a href='http://localhost/Blog-PHP/index.php'".$user['role']."</a>";
        }
      echo $user['role']; 
      ?>
      <br>
      <a href="http://localhost/Blog-PHP/logout.php">Logout</a>
    </div>
  </div>
<?php }else{ ?>
<?php
  $userregsql = "SELECT * FROM settings WHERE name='userreg'";
  $userregresult = $db->prepare($userregsql);
  $userregresult->execute();
  $userreg = $userregresult->fetch(PDO::FETCH_ASSOC);
  if($userreg['value'] == 'yes'){
    // Create CSRF token
    $token = md5(uniqid(rand(), TRUE));
    $_SESSION['csrf_token'] = $token;
    $_SESSION['csrf_token_time'] = time();
?>
  <!-- Side Widget -->
  <div class="card my-4">
    <h5 class="card-header">Login</h5>
    <div class="card-body">
      <form role="form" method="post" action="admin/login.php">
          <input type="hidden" name="csrf_token" value="<?php echo $token; ?>">
          <fieldset>
              <div class="form-group">
                  <input class="form-control" placeholder="E-mail or User Name" name="email" type="text" autofocus>
              </div>
              <div class="form-group">
                  <input class="form-control" placeholder="Password" name="password" type="password" value="">
              </div>
              <input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
          </fieldset>
      </form>
    </div>
  </div>
<?php } } ?>
</div>