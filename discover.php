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
    <section class="discover" id="discover">
      <div class="section__container discover__container">
        <h2 class="section__header">Discover the most engaging places</h2>
        <p class="section__subheader">
          Let's see the world with us with you and your family.
        </p>
        <div class="discover__grid">
          <div class="discover__card">
            <div class="discover__image">
              <img src="assets/discover-1.jpg" alt="discover" />
            </div>
            <div class="discover__card__content">
              <h4>Norway</h4>
              <p>
                Discover the untamed beauty of Norway, a land where rugged
                mountains, and enchanting northern lights paint a surreal
                backdrop.
              </p>
              <button class="discover__btn">
                Discover More <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>
          <div class="discover__card">
            <div class="discover__image">
              <img src="assets/discover-2.jpg" alt="discover" />
            </div>
            <div class="discover__card__content">
              <h4>London</h4>
              <p>
                From urban rock climbing to twilight cycling through royal
                parks, London beckons adventure enthusiasts to embrace
                opportunities.
              </p>
              <button class="discover__btn">
                Discover More <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>
          <div class="discover__card">
            <div class="discover__image">
              <img src="assets/discover-3.jpg" alt="discover" />
            </div>
            <div class="discover__card__content">
              <h4>Japan</h4>
              <p>
                From scaling the iconic peaks of Mount Fuji to immersing in the
                serenity, Japan offers adventurers a captivating cultural
                treasures.
              </p>
              <button class="discover__btn">
                Discover More <i class="ri-arrow-right-line"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php include ('footer.php'); ?>
    
</body>
</html>
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