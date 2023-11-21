<?php

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {
    require("models/users.php");
    require("models/posts.php");
    require("models/follows.php");

    $modelUser = new Users();
    $user = $modelUser->getById($_SESSION["user_id"]);

    $modelPosts = new Posts();
    $postsCount = $modelPosts->getPostsCountByUser($_SESSION["user_id"]);

    $modelFollows = new Follows();
    $followersCount = $modelFollows->getFollowersById($_SESSION["user_id"]);
    $followsCount = $modelFollows->getFollowsById($_SESSION["user_id"]);

    $limit = 3;

    $posts_number = $postsCount["posts_count"];

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

    $posts = $modelPosts->getPostsByUser($_SESSION["user_id"], $_SESSION["user_id"], $limit, $offset);

    if($page_number != $pages_number) {
        $next_page = $page_number + 1;
    }
    else {
        $page_number = 1;
        $next_page = $page_number;
    }

}

require("views/myprofile.php");

?>