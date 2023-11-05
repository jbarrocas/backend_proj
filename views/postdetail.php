<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <script src="/js/comments.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        
        <h1>Post detail</h1>
        <article class="post-container">
            <div data-post_id="<?= $post["post_id"]?>" class="post">
                <img class="post-image" src="/images/posts/<?=$post["photo"]?>" alt="">
                <h2 class="post-title"><?=$post["title"]?></h2>
                <p class="post-content"><?=$post["content"]?></p>
                <div class="post-signature">
                    <p class="post-date"><time><?=$post["post_date"]?></time></p>
                    <p class="post-author"><a href="/profile/<?= $post["user_id"]?>"><span class="username"><?= $post["username"]?></span></a> - <span class="post-country"><?=$post["country"]?></span></p>
                </div>
            </div>
        </article>

<?php
    if( isset($message) ) {
        echo '<p role="alert">' .$message. '</p>';
    }
?>

        <form id="commentForm" action="/requests/">
            <input id="commentContent" type="text" placeholder="Write your comment" minlength="10" maxlength="222" name="content">
            <button id="sendComment" type="button" name="send">Send Comment</button>
        </form>
        <p id="commentConfirmation"></p>
        <div id="sentComment">
                <p id="sentContent"></p>
                <p id="sentUsername"></p>
                <p><time id="sentDate"></time></p>
        </div>
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