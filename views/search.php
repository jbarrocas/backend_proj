<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <script src="/js/likes.js"></script>
    <script src="/js/search.js"></script>
    <script src="/js/posts_buttons.js"></script>
    <script src="/js/post_delete.js"></script>
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
        <h1 id="heading">Search</h1>
        <form action="/search/" method="get" id="searchForm">           
            <input type="text" name="search" id="searchText" minlength="3" maxlength="30">
            <button type="submit" name="submit">Search</button>
        </form>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
    
    if( isset($posts) ) {

        foreach($posts as $post) {
            echo '
                <article class="post-container">
                    <div class="post" name="post" id="post" data-post_id="' .$post["post_id"]. '" data-user_id="' .$post["user_id"]. '" data-session_id="' .$_SESSION["user_id"]. '">
                        <div class="content wrapper">
                            <a href="/postdetail/' .$post["post_id"]. '"><img class="post-image" src="/images/posts/' .$post["photo"]. ' " alt=""></a>
                            <h2 class="post-title">' .$post["title"]. '</h2>
                            <p class="post-content">' .$post["content"]. '</p>
                        </div>
                        <div class="post-signature">
                            <p class="post-date"><time>' .$post["post_date"]. '</time></p>
                            <figure>
                                <img class="user-photo" src="/images/users/' .$post["user_photo"]. '">
                            </figure>
                            <p class="post-author"><a href="/profile/' .$post["user_id"]. '"><span class="username">' .$post["username"]. '</span></a> - <span class="post-country">' .$post["country"]. '</span></p>
                        </div>
                    </div>
                    <div>
                        <button id="likeBtn'.$post["post_id"].'" type="button" data-user="' .$post["liked"]. '" name="like">Like</button>
                        <p id="likeCount' .$post["post_id"]. '">Likes <span id="likesNumber' .$post["post_id"]. '">' .$post["like_count"]. '</span></p>
                        <div><a href="/postdetail/' .$post["post_id"]. '">Comment</a></div>
                        <p>Comments <Span>' .$post["comments_count"]. '</span></p>
                        <div id="reportPostBtn"><a href="/report_post/' .$post["post_id"]. '">Report</a></div>
                        <button id="deletePostBtn" type="button" name="delete">Delete Post</button>
                    </div>
                </article>
            ';
        }
    }
?>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>