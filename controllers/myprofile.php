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
    $recentPostsByUsers = $modelPosts->getPostsByUser($_SESSION["user_id"], $_SESSION["user_id"]);

    $modelFollows = new Follows();
    $followersCount = $modelFollows->getFollowersById($_SESSION["user_id"]);
    $followsCount = $modelFollows->getFollowsById($_SESSION["user_id"]);

}

require("views/myprofile.php");

?>