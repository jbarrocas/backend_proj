<?php

header("Content-Type: application/json");

require("models/likes.php");

if( isset($_POST["request"]) ) {

    // if( $_POST["request"] === "likeCheck") {

    //     $modelLikes = new Likes();
    //     $likeCheck = $modelLikes->getLikesByPostAndUser($_POST["post_id"], $_SESSION["user_id"]);
    
    //     if( $likeCheck["total_count"] > 0) {

    //         echo '{"message":"liked"}';
    //     }
    //     else {
    //         echo '{"message":"unliked"}';
    //     }
    // }

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
}



?>