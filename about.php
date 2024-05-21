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
    <title>About us</title>
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
          <img src="assets/about.jpg" alt="about" />
        </div>
      </div>
    </section>
    <?php include ('footer.php'); ?>
    
</body>
</html>