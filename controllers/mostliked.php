<?php

require("models/users.php");

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {
    require("models/posts.php");

    $posts = new Posts();
    $mostLikedPosts = $posts->getMostLikedPosts($_SESSION["user_id"]);
}

require("views/mostliked.php");

?>