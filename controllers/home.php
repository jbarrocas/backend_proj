<?php

require("models/users.php");

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {

    $limit = 3;

    require("models/posts.php");
    $model = new Posts();
    $postsCount = $model->getPostsCount();

    $posts_number = $postsCount[0]["posts_count"];

    $pages_number = intval(ceil($posts_number / $limit));

    if(
        isset($_GET["page_number"]) &&
        is_numeric($_GET["page_number"])
        ) {
            htmlspecialchars(strip_tags(trim($_GET["page_number"])));

            $page_number = intval($_GET["page_number"]);
        }
    else {
        $page_number = 1;
    }

    if($page_number < 1 || $page_number > $pages_number) {

        $page_number = 1;
    }

    $offset = ($page_number - 1) * $limit;

    $posts = $model->getRecentPosts($_SESSION["user_id"], $limit, $offset);
    
    if($page_number != $pages_number) {
        $next_page = $page_number + 1;
    }
    else {
        $page_number = 1;
        $next_page = $page_number;
    }
    
}

require("views/home.php");

?>