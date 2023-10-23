<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PaddlePics</title>
</head>
<body>
    <main>
        <h1>Most Recent Paddle Strokes</h1>
<?php
    foreach($posts as $post) {
        echo '
            <article class="post-container">
                <div class="post">
                    <img class="post-image" src="../images/posts/' .$post["photo"]. ' " alt="' .$post["title"]. ' ">
                    <h2 class="post-title">' .$post["title"]. '</h2>
                    <p class="post-content">' .$post["content"]. '</p>
                    <div class="post-signature">
                        <p class="post-date">' .$post["post_date"]. '</p>
                        <p class="post-author">' .$post["username"]. ' - <span class="post-country">' .$post["country"]. '</span></p>
                    </div>
                </div>
                <div>
                    <p>' .$post["like_count"]. ' likes</p>
                </div>
            </article>
        ';
    }
?>

<?php
    if(isset($_POST["email"])){
?>
        <p><a href="<?= ROOT ?>/logout/">Logout</a></p>
<?php
    }
?>
    </main>    
</body>
</html>