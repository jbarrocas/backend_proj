<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PaddlePics</title>
    <script src="/js/home.js"></script>
</head>
<body>
    <main>
        <h1>Most Recent Paddle Strokes</h1>
<?php
    foreach($posts as $post) {
        echo '
            <article class="post-container">
                <div class="post" id="' .$post["post_id"]. '">
                    <img class="post-image" src="/images/posts/' .$post["photo"]. ' " alt="">
                    <h2 class="post-title">' .$post["title"]. '</h2>
                    <p class="post-content">' .$post["content"]. '</p>
                    <div class="post-signature">
                        <p class="post-date"><time>' .$post["post_date"]. '</time></p>
                        <p class="post-author">' .$post["username"]. ' - <span class="post-country">' .$post["country"]. '</span></p>
                    </div>
                </div>
                <div>
                    <button id="likeBtn'.$post["post_id"].'" type="button" data-user="' .$post["liked"]. '" name="like" aria-label="Paddle This">Paddle This</button>
                    <p>' .$post["like_count"]. ' paddles</p>
                </div>
            </article>
        ';
    }
?>

<?php
    if(isset($_SESSION["user_id"])){
?>
        <p><a href="/logout/">Logout</a></p>
<?php
    }
?>
    </main>    
</body>
</html>