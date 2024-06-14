<?php
// connect db
include('../db/connect-db.php');

// query for all categories
$sql = "SELECT * FROM `categories`"; 
$result = mysqli_query($conn, $sql);

// process results
$categories = mysqli_fetch_all($result, MYSQLI_ASSOC);

// free result
mysqli_free_result($result);

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
    <section class="category" id="category">
    <div class="section__container category__container">
        <h2 class="section__header">Latest on the blogs</h2>
        <p class="section__subheader">We want to help you to travel better!</p>
        <div class="category__grid">
            <?php foreach ($categories as $category): ?>
            <div class="category__card">
                <div class="category__image">
                    <img src="<?php echo $category['image']; ?>" alt="category">
                </div>
                <div class="category__card__content">
                    <h4><?php echo $category['cate_name']; ?></h4>
                    <p>
                        <?php echo $category['description']; ?>
                    </p>
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
          </div>
      </div>
    </section>

    <?php include ('footer.php'); ?>
    
</body>
</html>
