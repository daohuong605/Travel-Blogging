<?php
// Check if session is not already active before starting it
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

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
    <header id="home">
      <nav>
        <div class="nav__bar">
          <div class="nav__logo"><a href="#">Traveling Raido.</a></div>
          <ul class="nav__links">
            <li class="link"><a href="index.php">Home</a></li>
            <li class="link"><a href="about.php">About Us</a></li>
            <li class="link"><a href="Category.php">Category</a></li>
            <li class="link"><a href="blog.php">Personal</a></li>
            <li class="link"><a href="#contact">Contact</a></li>
            <!-- if not login -> show login -->
            <?php if (!isset($_SESSION['username'])): ?>
                <li class="link"><a class="nav-link" href="../auth/login.php">Login</a></li>
            <?php else: ?>
            <!-- else logout & manager -->
                <li class="link"><a class="nav-link" href="../auth/logout.php">Logout</a></li>
            <?php endif; ?>
            
            <li class="link search">
              <span><i class="ri-search-line"></i></span>
            </li>
          </ul>
        </div>
      </nav>
      <div class="section__container header__container">
        <h1>The new way to plan your next adventure</h1>
        <h4>Explore the colourful world</h4>
        <a href="create-article.php" class="btn">
          Explore More <i class="ri-arrow-right-line"></i>
      </a>
      </div>
    </header>
  </body>
</html>