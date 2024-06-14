<?php

// connect db
include('../db/connect-db.php');

// query for all articles
$sql2 = "SELECT * FROM `articles` WHERE `cate_id` = 7";
$result2 = mysqli_query($conn, $sql2);

// process results
$articles = mysqli_fetch_all($result2, MYSQLI_ASSOC); // Thêm dòng này để lấy tất cả các bài viết

// free result
mysqli_free_result($result2);

// close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="libs/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Category</title>
</head>
<body>
    <?php include('header.php'); ?>
    <section class="journals" id="journals">
      <div class="section__container journals__container">
        <h2 class="section__header">The travel journals</h2>
        <p class="section__subheader">
          A journal is a place to record new things you have discovered while
          exploring various places you visit.
        </p>
        <div class="journals__grid">
        <?php foreach ($articles as $article): ?>
          <div class="journals__card">
            <a href="blog-details.php?article_id=<?php echo $article['article_id']; ?>" class="journals__link">
                <img src="<?php echo $article['image']; ?>" alt="journal" />
                <div class="journals__content">
                    <div class="journals__author">
                        <img src="../assets/author-1.jpg" alt="author" />
                        <p style="color: white;">By Marry Ann</p>
                    </div>
                    <h4 style="color: white;"><?php echo $article['title']; ?></h4>
                    <div class="journals__footer">
                        <p style="color: white;"><?php echo $article['create_at']; ?></p>
                        <span>
                            <a href="#"><i style="color: white;" class="ri-share-fill"></i></a>
                        </span>
                    </div>
                </div>
            </a>
        </div>
        <?php endforeach; ?>
        </div>
        <div class="journals__btn">
        <?php if (!isset($_SESSION['username'])): ?>
          <a href="../auth/login.php">
          <button class="btn">
            View All Journals <i class="ri-arrow-right-line"></i>
          </button>
        <?php endif; ?>
        </div>
      </div>
    </section>
    <?php include ('footer.php'); ?>
    
</body>
</html>
      