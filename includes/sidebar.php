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
              <a href="category.php?id=<?php echo $cat['id']; ?>"><?php echo $cat['title']; ?></a>
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

  $postsql = "SELECT * FROM posts LIMIT 5";
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
              <a href="single.php?id=<?php echo $post['id']; ?>"><?php echo $post['title']; ?></a>
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

  $pagesql = "SELECT * FROM pages LIMIT 5";
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
              <a href="page.php?id=<?php echo $page['id']; ?>"><?php echo $page['title']; ?></a>
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
</div>