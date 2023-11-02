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
<?php
    if( isset($message) ) {
        echo '<p role="alert">' .$message. '</p>';
    }
?>
        <article class="post-container">
            <div id="<?= $post["post_id"]?>" class="post">
                <img class="post-image" src="/images/posts/<?=$post["photo"]?>" alt="">
                <h2 class="post-title"><?=$post["title"]?></h2>
                <p class="post-content"><?=$post["content"]?></p>
                <div class="post-signature">
                    <p class="post-date"><time><?=$post["post_date"]?></time></p>
                    <p class="post-author"><a href="/profile/<?= $post["user_id"]?>"><span class="username"><?= $post["username"]?></span></a> - <span class="post-country"><?=$post["country"]?></span></p>
                </div>
            </div>
        </article>
        <form class="comment-Form" method="POST" action="/postdetail/<?= $post["post_id"]?>">
            <textarea id="commentContent" placeholder="Write your comment" cols="74" rows="3" minlength="10" maxlength="222" name="content"></textarea>
            <button id="sendComment" type="submit" name="send_comment">Send</button>
        </form>
<?php
    foreach($comments as $comment) {
        echo '
            <div id="comment' .$comment["comment_id"]. '">
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