<?php

header("Content-Type: application/json");

require("models/likes.php");
require("models/follows.php");

if( isset($_POST["request"]) ) {

    if(
        $_POST["request"] === "createLike" &&
        !empty($_POST["post_id"]) &&
        is_numeric($_POST["post_id"])

    ) {

        $model = new Likes();
        $like = $model->createLike($_POST["post_id"], $_SESSION["user_id"]);

        echo '{"message":"created"}';
    }

    if(
        $_POST["request"] === "deleteLike" &&
        !empty($_POST["post_id"]) &&
        is_numeric($_POST["post_id"])

    ) {

        $model = new Likes();
        $like = $model->deleteLike($_POST["post_id"], $_SESSION["user_id"]);

        echo '{"message":"deleted"}';
    }

    if(
        $_POST["request"] === "createFollower" &&
        !empty($_POST["user_id"]) &&
        is_numeric($_POST["user_id"])

    ) {

        $model = new Follows();
        $follow = $model->createFollow($_POST["user_id"], $_SESSION["user_id"]);

        echo '{"message":"followed"}';
    }

    if(
        $_POST["request"] === "deleteFollower" &&
        !empty($_POST["user_id"]) &&
        is_numeric($_POST["user_id"])

    ) {

        $model = new Follows();
        $follow = $model->deleteFollow($_POST["user_id"], $_SESSION["user_id"]);

        echo '{"message":"unfollowed"}';
    }
}



?>