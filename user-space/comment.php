<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css"
      rel="stylesheet"
    />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"
    />
    <link rel="stylesheet" href="libs/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="libs/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="styles.css" />
    <script src="https://unpkg.com/scrollreveal"></script>
    <title>Comments</title>
    <style>
        body {
            display: block;
            margin: 0;
            padding: 0;
            font-family: system-ui;
            font-size: 16px;
            background: white;
            margin-top: 20px;
        }

        .flex {
            display: flex;
            justify-content: space-around;
            width: 100%;
        }

        img {
            width: 100%;
            height: 100%;
        }

        .comment-box,
        .comment-list {
            background: white;
            border-radius: 4px;
            box-shadow: 0 2px 2px #0002;
        }

        .comment-session {
            width: auto;
            height: auto;
            margin: 0 auto;
        }

        .comment-list {
            width: 100%;
            margin-bottom: 12px;
        }

        .comment-list .user {
            display: flex;
            padding: 8px;
            overflow: hidden;
        }

        .comment-box .user img {
            height: 60px;
            width: 60px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment-list .day {
            font-size: 12px;
        }

        .post-comment .comment {
            padding: 0 0 15px 58px;
        }

        .comment-box {
            padding: 10px;
            overflow: hidden;
        }

        .comment-box .user {
            display: flex;
            width: min-content;
        }

        .comment-box .user .image img {
            width: 24px;
            height: 24px;
            margin-right: 10px;
            border-radius: 50%;
        }

        .comment-box textarea {
            background-color: rgba(255, 255, 255, 0);
            width: -webkit-fill-available;
            height: 152px;
            margin: 10px 0;
            padding: 10px;
            border: none;
            border-radius: 4px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .comment-box textarea:focus {
            outline-color: black;
        }

        .comment-box .comment--submit {
            float: right;
            padding: 6px 14px;
            border: none;
            background: black;
            color: #eee;
            cursor: pointer;
            border-radius: 4px;
        }

        .comment-list-item {
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .comment-list-item:last-child {
            border-bottom: none;
        }

        .comment-list-item .user-img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .comment-list-item .comment-content {
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <section class="blog" id="detailed_blog">
        <div class="container">
            <div class="comment-session">
                <!-- Post comment section -->
                <div class="post-session">
                    <form action="post_comment.php" method="POST" class="comment-box">
                        <textarea name="comment" placeholder="Write your comment"></textarea>
                        <input type="hidden" name="article_id" value="<?php echo htmlspecialchars($_GET['article_id']); ?>">
                        <button type="submit" class="comment--submit">Comment</button>
                    </form>
                </div>

                <!-- Display existing comments -->
                <div class="comment-list">
                    <?php
                    // Include database connection
                    include('../db/connect-db.php');

                    // Fetch comments based on article_id
                    $article_id = $_GET['article_id'] ?? 0;
                    $sql = "SELECT * FROM comments WHERE article_id = $article_id ORDER BY created_at DESC";
                    $result = mysqli_query($conn, $sql);

                    if ($result && mysqli_num_rows($result) > 0) {
                        while ($comment = mysqli_fetch_assoc($result)) {
                            ?>
                            <div class="comment-list-item">
                                <div class="comment-content">
                                    <span class="day"><?php echo htmlspecialchars($comment['created_at']); ?></span>
                                    <p><?php echo htmlspecialchars($comment['comment']); ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        echo '<p>No comments yet.</p>';
                    }

                    // Close database connection
                    mysqli_close($conn);
                    ?>
                </div>
            </div>
        </div>
    </section>
</body>
</html>
