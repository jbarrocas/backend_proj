<?php

require("models/users.php");

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {
    require("models/posts.php");

    $model = new Posts();
    $posts = $model->getMostLikedPostsMonth($_SESSION["user_id"]);
    $postAuxs = $model->getMostLikedPostsWeek($_SESSION["user_id"]);
}

require("views/mostliked.php");

?>