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
    <section class="blogs" id="blog">
      <div class="blogs__container">
        <h2 class="section__header">Latest on the blogs</h2>
        <p class="section__subheader">We want to help youto travel better!</p>
        <div class="blogs__grid">
          <div class="blogs__card">
            <img src="assets/blog-1.jpg" alt="blog" />
            <div class="blogs__content">
              10 mistakes every first time traveller will make and how to avoid
              them!
            </div>
          </div>
          <div class="blogs__card">
            <img src="assets/blog-2.jpg" alt="blog" />
            <div class="blogs__content">
              What's it really like to move to a country where you don't speak
              the language?
            </div>
          </div>
          <div class="blogs__card">
            <img src="assets/blog-3.jpg" alt="blog" />
            <div class="blogs__content">
              Exploring the quite corners of Oslo | Gallop around the globe.
            </div>
          </div>
          <div class="blogs__card">
            <img src="assets/blog-4.jpg" alt="blog" />
            <div class="blogs__content">
              11 things to know before you visit rainbow mountain in Peru.
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include ('footer.php'); ?>
    
</body>
</html>