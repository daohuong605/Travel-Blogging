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
              <img src="assets/discover-1.jpg" alt="category" />
            </div>
            <div class="category__card__content">
              <h4>Norway</h4>
              <p>
                Discover the untamed beauty of Norway, a land where rugged
                mountains, and enchanting northern lights paint a surreal
                backdrop.
              </p>
              <button class="category__btn">
                Read More <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>
          <div class="category__card">
            <div class="category__image">
              <img src="assets/discover-2.jpg" alt="category" />
            </div>
            <div class="category__card__content">
              <h4>London</h4>
              <p>
                From urban rock climbing to twilight cycling through royal
                parks, London beckons adventure enthusiasts to embrace
                opportunities.
              </p>
              <button class="category__btn">
                Read More <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>
          <div class="category__card">
            <div class="category__image">
              <img src="assets/discover-3.jpg" alt="category" />
            </div>
            <div class="category__card__content">
              <h4>Japan</h4>
              <p>
                From scaling the iconic peaks of Mount Fuji to immersing in the
                serenity, Japan offers adventurers a captivating cultural
                treasures.
              </p>
              <button class="category__btn">
                Read More <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include ('footer.php'); ?>
    
</body>
</html>
      