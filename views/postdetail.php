<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post</title>
    <link rel="stylesheet" href="/css/postdetails.css">
    <script src="/js/comments.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        
        <h1>Post detail</h1>
        <div class="posts-comments-wrapper">
            <article class="post-container">
                <div data-post_id="<?= $post["post_id"]?>" id="post">
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
                <textarea id="commentContent" type="text" placeholder="Write your comment" cols="72" rows="3" minlength="10" maxlength="222" name="content"></textarea>
                <button id="sendComment" type="button" name="sendComment">Send Comment</button>
            </form>
            <div id="sentComment">
                    <p id="sentContent"></p>
                    <p id="sentUsername"></p>
                    <p><time id="sentDate"></time></p>
            </div>
<?php
    foreach($comments as $comment) {
        echo '            
                <div id="comment" data-comment_id="' .$comment["comment_id"]. '">
                    <p>' .$comment["content"]. '</p>
                    <p>' .$comment["username"]. ' - ' .$comment["country"]. '</p>
                    <p><time>' .$comment["comment_date"]. '</time></p>
                    <div id="action">
                        <button id="reply" type="button" name="reply">Reply</button>
                        <div><a href="/report_comment/' .$comment["comment_id"]. '">Report</a></div>
                    </div>
                </div>
                <form id="replyForm" class="reply-form hide" action="/requests/" data-reply_check="' .$comment["parent_id"]. '">
                    <textarea id="replyContent" data-comment_id="' .$comment["comment_id"]. '" type="text" placeholder="Write your reply" cols="72" rows="3" minlength="10" maxlength="222" name="replyContent"></textarea>
                    <button id="sendReply" type="button" name="sendReply">Send Reply</button>
                </form>
                <div id="sentReply" class="comment-reply">
                        <p id="sentReplyContent' .$comment["comment_id"]. '"></p>
                        <p id="sentReplyUsername' .$comment["comment_id"]. '"></p>
                        <p><time id="sentReplyDate' .$comment["comment_id"]. '"></time></p>
                </div>
        ';
    }
?>
        </div>
    </main>    
</body>
</html>