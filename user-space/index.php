<?php

// connect db
include('../db/connect-db.php');

// query for all categories
$sql = "SELECT * FROM `categories`"; 
$result = mysqli_query($conn, $sql);

// query for all articles
$sql2 = "SELECT * FROM `articles`";
$result2 = mysqli_query($conn, $sql2);

// process results
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);
$articles = mysqli_fetch_all($result2, MYSQLI_ASSOC); // Thêm dòng này để lấy tất cả các bài viết

// free result
mysqli_free_result($result);

// close connection
mysqli_close($conn);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link rel="stylesheet" href="styles.css" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Web Design Mastery | Raido.</title>
  </head>
  <body>
  <?php include('header.php'); ?>

    <section class="about" id="about">
      <div class="section__container about__container">
        <div class="about__content">
          <h2 class="section__header">About us</h2>
          <p class="section__subheader">
            Our mission is to ignite the spirit of discovery in every traveler's
            heart, offering meticulously crafted itineraries that blend
            adrenaline-pumping activities with awe-inspiring landscapes. With a
            team of seasoned globetrotters, we ensure that every expedition is
            infused with excitement, grace our planet. Embark on a voyage of a
            lifetime with us, as we redefine the art of exploration.
          </p>
          <div class="about__flex">
            <div class="about__card">
              <h4>268</h4>
              <p>Completed Trips</p>
            </div>
            <div class="about__card">
              <h4>176</h4>
              <p>Tour Guides</p>
            </div>
            <div class="about__card">
              <h4>153</h4>
              <p>Destinations</p>
            </div>
          </div>
          <button class="btn">
            Read More <i class="ri-arrow-right-line"></i>
          </button>
        </div>
        <div class="about__image">
          <img src="../assets/about.jpg" alt="about" />
        </div>
      </div>
    </section>

    <section class="category" id="category">
        <div class="section__container category__container">
            <h2 class="section__header">Latest on the blogs</h2>
            <p class="section__subheader">We want to help you to travel better!</p>
            <div class="category__grid">
                <?php if (empty($categories)): ?>
                    <p>No categories found.</p>
                <?php else: ?>
                    <?php foreach ($categories as $category): ?>
                        <div class="category__card">
                            <div class="category__image">
                                <img src="<?php echo $category['image']; ?>" alt="category">
                            </div>
                            <div class="category__card__content">
                                <h4><?php echo $category['cate_name']; ?></h4>
                                <p><?php echo $category['description']; ?></p>
                                <?php if (!isset($_SESSION['username'])): ?>
                                    <a href="../auth/login.php">
                                        <button class="category__btn">
                                            Read More <i class="ri-arrow-right-line"></i>
                                        </button>
                                    </a>
                                <?php else: ?>
                                    <a href="FoodDetails.php?cate_id=<?php echo $category['cate_id']; ?>">
                                        <button class="category__btn">
                                            Read More <i class="ri-arrow-right-line"></i>
                                        </button>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>


    <section class="blogs" id="blog">
      <div class="blogs__container">
        <h2 class="section__header">Latest on the blogs</h2>
        <p class="section__subheader">We want to help youto travel better!</p>
        <div class="blogs__grid">
          <div class="blogs__card">
            <img src="../assets/blog-1.jpg" alt="blog" />
            <div class="blogs__content">
              10 mistakes every first time traveller will make and how to avoid
              them!
            </div>
          </div>
          <div class="blogs__card">
            <img src="../assets/blog-2.jpg" alt="blog" />
            <div class="blogs__content">
              What's it really like to move to a country where you don't speak
              the language?
            </div>
          </div>
          <div class="blogs__card">
            <img src="../assets/blog-3.jpg" alt="blog" />
            <div class="blogs__content">
              Exploring the quite corners of Oslo | Gallop around the globe.
            </div>
          </div>
          <div class="blogs__card">
            <img src="../assets/blog-4.jpg" alt="blog" />
            <div class="blogs__content">
              11 things to know before you visit rainbow mountain in Peru.
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="journals" id="journals">
        <div class="section__container journals__container">
            <h2 class="section__header">The travel journals</h2>
            <p class="section__subheader">
                A journal is a place to record new things you have discovered while
                exploring various places you visit.
            </p>
            <div class="journals__grid">
                <?php if (empty($articles)): ?>
                    <p>No articles found.</p>
                <?php else: ?>
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
                <?php endif; ?>
            </div>
            <div class="journals__btn">
                <?php if (!isset($_SESSION['username'])): ?>
                    <a href="../auth/login.php">
                        <button class="btn">
                            View All Journals <i class="ri-arrow-right-line"></i>
                        </button>
                    </a>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <section class="hero">
      <div class="section__container hero__container">
        <p>Raido.</p>
      </div>
    </section>

    <section class="gallery" id="gallery">
      <div class="gallery__container">
        <h2 class="section__header">Gallery photos</h2>
        <p class="section__subheader">
          Explore the most beautiful places in the world.
        </p>
        <div class="gallery__grid">
          <div class="gallery__card">
            <img src="../assets/gallery-1.jpg" alt="gallery" />
            <div class="gallery__content">
              <h4>Northern Lights</h4>
              <p>Norway</p>
            </div>
          </div>
          <div class="gallery__card">
            <img src="../assets/gallery-2.jpg" alt="gallery" />
            <div class="gallery__content">
              <h4>Krabi</h4>
              <p>Thailand</p>
            </div>
          </div>
          <div class="gallery__card">
            <img src="../assets/gallery-3.jpg" alt="gallery" />
            <div class="gallery__content">
              <h4>Bali</h4>
              <p>Indonesia</p>
            </div>
          </div>
          <div class="gallery__card">
            <img src="../assets/gallery-4.jpg" alt="gallery" />
            <div class="gallery__content">
              <h4>Tokyo</h4>
              <p>Japan</p>
            </div>
          </div>
          <div class="gallery__card">
            <img src="../assets/gallery-5.jpg" alt="gallery" />
            <div class="gallery__content">
              <h4>Taj Mahal</h4>
              <p>India</p>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="contact" id="contact">
      <div class="section__container contact__container">
        <div class="contact__col">
          <h4>Contact a travel researcher</h4>
          <p>We always aim to reply within 24 hours.</p>
        </div>
        <div class="contact__col">
          <div class="contact__card">
            <span><i class="ri-phone-line"></i></span>
            <h4>Call us</h4>
            <h5>+91 9876543210</h5>
            <p>We are online now</p>
          </div>
        </div>
        <div class="contact__col">
          <div class="contact__card">
            <span><i class="ri-mail-line"></i></span>
            <h4>Send us an enquiry</h4>
          </div>
        </div>
      </div>
    </section>

    <?php include('footer.php'); ?>
    <script src="main.js"></script>
  </body>
</html>
