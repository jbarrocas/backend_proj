<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search</title>
    <script src="/js/likes.js"></script>
    <script src="/js/search.js"></script>
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
<?php
    if(isset($_GET["search"])) {
        echo '<input type="hidden" name="get" id="getCheck" value="' .$_GET["search"]. '">';
    }
?>            
            <input type="text" name="search" id="searchText" minlength="3" maxlength="30">
            <button type="submit" name="submit">Search</button>
        </form>
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
?>
        <p id="result"></p>
<?php
    if( isset($posts) ) {

        foreach($posts as $post) {
            echo '
                <article class="post-container">
                    <div class="post" data-post_id="' .$post["post_id"]. '">
                        <div class="content wrapper">
                            <a href="/postdetail/' .$post["post_id"]. '"><img class="post-image" src="/images/posts/' .$post["photo"]. ' " alt=""></a>
                            <h2 class="post-title">' .$post["title"]. '</h2>
                            <p class="post-content">' .$post["content"]. '</p>
                        </div>
                        <div class="post-signature">
                            <p class="post-date"><time>' .$post["post_date"]. '</time></p>
                            <p class="post-author"><a href="/profile/' .$post["user_id"]. '"><span class="username">' .$post["username"]. '</span></a> - <span class="post-country">' .$post["country"]. '</span></p>
                        </div>
                    </div>
                    <div>
                        <button id="likeBtn'.$post["post_id"].'" type="button" data-user="' .$post["liked"]. '" name="like">Like</button>
                        <p id="likeCount' .$post["post_id"]. '"><span id="likesNumber' .$post["post_id"]. '">' .$post["like_count"]. '</span> likes</p>
                        <div><a href="/postdetail/' .$post["post_id"]. '">Comment</a></div>
                        <p><Span>' .$post["comments_count"]. '</span> comments</p>
                        <div><a href="/report_post/' .$post["post_id"]. '">Report</a></div>
                    </div>
                </article>
            ';
        }
    }
?>
    </main>    
</body>
</html>