<?php

require("models/users.php");

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {
    require("models/posts.php");

    $modelRecentPosts = new Posts();
    $recentPosts = $modelRecentPosts->getRecentPosts();
}

require("views/home.php");

?>