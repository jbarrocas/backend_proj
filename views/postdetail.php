<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        <h1>Post detail</h1>
        <article class="post-container">
            <div class="post">
                <img class="post-image" src="/images/posts/<?=$post["photo"]?>" alt="">
                <h2 class="post-title"><?=$post["title"]?></h2>
                <p class="post-content"><?=$post["content"]?></p>
                <div class="post-signature">
                    <p class="post-date"><time><?=$post["post_date"]?></time></p>
                    <p class="post-author"><?=$post["username"]?> - <span class="post-country"><?=$post["country"]?></span></p>
                </div>
            </div>
        </article>
<?php
    foreach($comments as $comment) {
        echo '
            <div class="comment">
                <p>' .$comment["content"]. '</p>
                <p>' .$comment["username"]. ' - ' .$comment["country"]. '</p>
                <p><time>' .$comment["comment_date"]. '</time></p>
            </div>
        ';
    };
?>
    </main>    
</body>
</html>