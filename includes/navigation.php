<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
  <div class="container">
    <?php
        $titlesql = "SELECT * FROM settings WHERE name='sitetitle'";
        $titleresult = $db->prepare($titlesql);
        $titleresult->execute();
        $title = $titleresult->fetch(PDO::FETCH_ASSOC);

        $tagsql = "SELECT * FROM settings WHERE name='tagline'";
        $tagresult = $db->prepare($tagsql);
        $tagresult->execute();
        $tag = $tagresult->fetch(PDO::FETCH_ASSOC);
    ?>
    <a class="navbar-brand" href="http://localhost/Blog-PHP/index.php"><?php echo $title['value']; ?> | <?php echo $tag['value']; ?></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarResponsive">
      <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
          <a class="nav-link" href="http://localhost/Blog-PHP/index.php">Home
            <span class="sr-only">(current)</span>
          </a>
        </li>
        <?php
          $sql = "SELECT * FROM categories";
          $result = $db->prepare($sql);
          $result->execute();
          $res = $result->fetchAll(PDO::FETCH_ASSOC);
          foreach ($res as $cat) {
        ?>
        <li class="nav-item">
          <a class="nav-link" href="http://localhost/Blog-PHP/category/<?php echo $cat['slug']; ?>"><?php echo $cat['title']; ?></a>
        </li>
        <?php } ?>
        <li class="nav-item">
          <a class="nav-link" href="#">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>