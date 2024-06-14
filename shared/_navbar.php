<nav class="navbar navbar-expand-lg bg-body-tertiary flex-column fixed-top">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="../assets/logo.webp" alt="Edit" width="60" height="45"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="../user-space/index.php">User space</a>
                </li>
                
                <!-- if not login -> show login -->
                <?php if (!isset($_SESSION['username'])): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/login.php">Login</a>
                    </li>
                <?php else: ?>
                    <!-- else logout & manager -->
                    <li class="nav-item">
                        <a class="nav-link" href="../auth/logout.php">Logout</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage users
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../users/all-user.php">All users</a></li>
                            <li><a class="dropdown-item" href="../auth/signup.php">Add user</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage categories
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../category/index.php">All categories</a></li>
                            <li><a class="dropdown-item" href="../category/create.php">Add new category</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage articles
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../articles/view.php">All articles</a></li>
                            <li><a class="dropdown-item" href="../articles/article.php">Add new article</a></li>
                        </ul>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Manage comments
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="../comment/index.php">All comments</a></li>
                            <li><a class="dropdown-item" href="../comment/create.php">Add new comment</a></li>
                        </ul>
                    </li>
                <?php endif; ?>
            </ul>
            <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
