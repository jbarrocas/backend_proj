<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PaddlePics</title>
</head>
<body>
    <main>
        <h1>Posts</h1>

<?php
    foreach($posts as $post) {
        echo '
            <article class="post">
                <img class="post-image" src="' .$post["photo"]. '" alt="' .$post["title"]. '">
                <h2 class="post-title">' .$post["title"]. '</h2>
                <p class="post-content">' .$post["content"]. '</p>
                <div class="post-signature">
                    <p class="post-date">' .$post["post_date"]. '</p>
                    <p class="post-author">' .$post["username"]. ' - <span class="post-country">' .$post["country"]. '</span></p>
                </div>
            </article>
        ';
    }
?>

    </main>    
</body>
</html>