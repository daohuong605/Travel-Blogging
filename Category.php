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
    <section class="category" id="category">
      <div class="section__container category__container">
        <h2 class="section__header">Latest on the blogs</h2>
        <p class="section__subheader">We want to help youto travel better!</p>
        <div class="category__grid">
          <div class="category__card">
            <div class="category__image">
              <img src="assets/food-cate.jpg" alt="category" />
            </div>
            <div class="category__card__content">
              <h4>Food Traveling</h4>
              <p>
              Food travel bloggers often write about local restaurants, 
              street food experiences, and unique food experiences.
              </p>
              <a href="FoodDetails.php">
                <button class="category__btn">
                    Read More <i class="ri-arrow-right-line"></i>
                </button>
              </a>
            </div>
          </div>
          <div class="category__card">
            <div class="category__image">
              <img src="assets/adventure-cate.jpg" alt="category" />
            </div>
            <div class="category__card__content">
              <h4>Adventure Traveling</h4>
              <p>
              Adventure travel bloggers often write about hiking, camping, 
              rock climbing, and other outdoor activities.
              </p>
              <a href="AdventureDetails.php">
                <button class="category__btn">
                    Read More <i class="ri-arrow-right-line"></i>
                </button>
              </a>
            </div>
          </div>
          <div class="category__card">
            <div class="category__image">
              <img src="assets/discover-3.jpg" alt="category" />
            </div>
            <div class="category__card__content">
              <h4>Cultural Traveling</h4>
              <p> 
              Cultural travel bloggers often write about history, art, architecture, and other aspects of local cultures.
              </p>
              <a href="CulturalDetails.php">
                <button class="category__btn">
                    Read More <i class="ri-arrow-right-line"></i>
                </button>
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include ('footer.php'); ?>
    
</body>
</html>
      