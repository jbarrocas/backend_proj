<?php

require("models/users.php");

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {
    require("models/posts.php");
    require("models/likes.php");

    $modelPosts = new Posts();
    $posts = $modelPosts->getRecentPosts();
}

require("views/home.php");

?>