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
    <title>Personal account</title>
</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap");
body {
  width: 100%;
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  min-height: 100vh;
  font-family: "Poppins", sans-serif;
}

.header__wrapper.img__container {
  position: absolute;
  transform: translatex(-50%);
}
.header__wrapper .img__container img {
  width: 200px;
  height: 200px;
  object-fit: cover;
  border-radius: 50%;
  display: block;
  box-shadow: 1px 3px 12px rgba(0, 0, 0, 0.18);
}
.header__wrapper h2 {
  margin-top: 20px;
  font-weight: 600;
  font-size: 22px;
  margin-bottom: 5px;
  text-align: center;
  margin-left: 90px;

}


</style>
<body>
    <?php include('header.php'); ?>
    <section class="journals" id="journals">
        <div class="header__wrapper">
          <div class="container">
              <div class="row">
                  <div class="col-sm-3 d-flex align-items-center">
                      <div class="col-sm-6">
                        <div class="img__container image-fluid">
                            <img src="assets/author-1.jpg" alt="avatar" />
                        </div>
                        <div class="col-sm-6 d-flex justify-content-center align-items-center">
                          <h2>Aaran Kenneedy</h2>
                        </div>
                    </div>
                </div>
              </div>
          </div>
        </div>
    </section>

        <section class="discover" id="discover">
           <div class="container">
           <div class="section__container discover__container">
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
                            <a href="blog-details.php" class="discover__btn">
                                Detailed More <i class="ri-arrow-right-line"></i>
                            </a>

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
                                <a href="blog-details.php" class="discover__btn">
                                    Detailed More <i class="ri-arrow-right-line"></i>
                                </a>
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
                                <a href="blog-details.php" class="discover__btn">
                                    Detailed More <i class="ri-arrow-right-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
              </div>
           </div>
        </section>
    <?php include ('footer.php'); ?>
    
</body>
</html>