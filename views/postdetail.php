<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post - <?= $post["title"] ?></title>

    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/comments.js"></script>
</head>
<body>
    <main>
<?php
    if(isset($_SESSION["is_admin"]) || isset($_SESSION["is_super_admin"])) {
        require("templates/adminmenu.php");
    }
    else {
        require("templates/menu.php");
    }
?>
        <div class="page-content">
            <h1 class="heading-1"><?= $post["title"] ?></h1>
                <div class="posts-comments-wrapper">
                    <article class="post-container">
                        <div class="post" data-post_id="<?= $post["post_id"]?>" id="post">
                            <div class="content-wrapper">
                                <img class="post-image" src="/images/posts/<?=$post["photo"]?>" alt="">
                                <h2 class="post-title"><?=$post["title"]?></h2>
                                <p class="post-content"><?=$post["content"]?></p>
                            </div>
                            <div class="post-signature">
                                <p class="post-date"><time><?=$post["post_date"]?></time></p>
                                <div class="author">
                                    <figure>
                                        <img class="user-photo" src="/images/users/<?=$post["user_photo"]?>">
                                    </figure>
                                    <p class="post-author"><a href="/profile/<?= $post["user_id"]?>"><span class="username"><?= $post["username"]?></span></a> - <span class="post-country"><?=$post["country"]?></span></p>
                                </div>
                            </div>
                        </div>
                    </article>
<?php
    if( isset($message) ) {
        echo '<p class="comment-error-message" role="alert">' .$message. '</p>';
    }
?>
                    <p class="comment-error-message" id="commentErrorMessage" role="alert"></p>
                    <form class="comment-form" id="commentForm" action="/requests/">
                        <textarea class="comment-content-input" id="commentContent" type="text" placeholder="Write your comment" aria-label="Write your comment" cols="72" rows="3" minlength="3" maxlength="222" name="content"></textarea>
                        <input type="hidden" name="commentToken" value="<?= $_SESSION["token"] ?>">
                        <button class="send-comment" id="sendComment" type="button" name="sendComment">Send Comment</button>
                    </form>
                    <div class="sent-comment hide" id="sentComment">
                        <div class="sent-author">
                            <p class="sent-username" id="sentUsername"></p>
                            <p><time class="comment-date" id="sentDate"></time></p>
                        </div>                        
                        <p class="sent-content" id="sentContent"></p>
                    </div>                    
<?php
    foreach($comments as $comment) {
        echo '  <div id="comment" class="comment" data-comment_id="' .$comment["comment_id"]. '">
                    <div>
                        <div class="comment-signature">
                            <div class="author">
                                <figure>
                                <img class="user-photo" src="/images/users/' .$comment["photo"]. '">
                                </figure>
                                <p class="username">' .$comment["username"]. ' - <span class="user-country">' .$comment["country"]. '</span></p>
                            </div>
                            <p class="comment-date"><time>' .$comment["comment_date"]. '</time></p>
                        </div>
                        <p class="comment-content">' .$comment["content"]. '</p>
                    </div>                    
                    <div class="comment-action" id="action">
                        <button class="reply-button" id="reply" type="button" name="reply">Reply</button>
                        <a href="/report_comment/' .$comment["comment_id"]. '"><div class="report-comment">Report</div></a>
                    </div>
                </div>
                <form id="replyForm" class="reply-form hide" action="/requests/" data-reply_check="' .$comment["parent_id"]. '">
                    <textarea class="reply-input" id="replyContent" data-comment_id="' .$comment["comment_id"]. '" aria-label="Write you reply" type="text" placeholder="Write your reply" cols="72" rows="3" minlength="3" maxlength="222" name="replyContent"></textarea>
                    <input type="hidden" name="replyToken" value="' .$_SESSION["token"]. '">
                    <button class="send-reply-button" id="sendReply" type="button" name="sendReply">Send Reply</button>
                </form>
                <p class="reply-error-message" id="replyErrorMessage' .$comment["comment_id"]. '" role="alert"></p> 
                <div class="sent-reply hide" id="sentReply' .$comment["comment_id"]. '">
                    <div class="sent-reply-author">
                        <p class="sent-reply-username" id="sentReplyUsername' .$comment["comment_id"]. '"></p>
                        <p class="sent-reply-date"><time id="sentReplyDate' .$comment["comment_id"]. '"></time></p>
                    </div>
                    <p class="sent-reply-content" id="sentReplyContent' .$comment["comment_id"]. '"></p>                        
                </div>                
        ';
    }
?>
            </div>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>