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
    <title>Commmet</title>
</head>

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

.comment-box, .comment-list {
  background: white;
  border-radius: 4px;
  box-shadow: 0 2px 2px #0002;
}

.comment-session {
  width: 650px;
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
    padding: 10 px;
    border: none;
    border-radius: 4px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}
.comment-box textarea:focus{
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
</style>
<body>
        <section class="blog" id="detailed_blog">
           <div class="container"> <div class="commnent-session">
                <div class="post-session">
                    <form action="" class="comment-box">
                        <div class="user">
                            <div class="image">
                                <img src="assets/author-2.jpg" alt="user"/>
                            </div>
                            <div class="name">Rajkamal</div>
                        </div>
                        <textarea name="comment">Comment</textarea>
                        <button class="comment--submit">Comment</button>
                    </form>
                </div>
            </div> 
        </section>
</body>
</html>