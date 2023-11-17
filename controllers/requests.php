<?php

header("Content-Type: application/json");

require("models/likes.php");
require("models/follows.php");
require("models/posts.php");
require("models/comments.php");
require("models/users.php");



if( isset($_POST["request"]) ) {

    foreach($_POST as $key => $value){
        $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
    }

    // Likes

    if(
        $_POST["request"] === "createLike" &&
        !empty($_POST["post_id"]) &&
        is_numeric($_POST["post_id"])
    ) {

        $model = new Likes();
        $model->createLike($_POST["post_id"], $_SESSION["user_id"]);

        echo '{"message":"created"}';
    }

    if(
        $_POST["request"] === "deleteLike" &&
        !empty($_POST["post_id"]) &&
        is_numeric($_POST["post_id"])
    ) {

        $model = new Likes();
        $model->deleteLike($_POST["post_id"], $_SESSION["user_id"]);

        echo '{"message":"deleted"}';
    }

    // Follows

    if(
        $_POST["request"] === "createFollower" &&
        !empty($_POST["user_id"]) &&
        is_numeric($_POST["user_id"])
    ) {

        $model = new Follows();
        $model->createFollow($_POST["user_id"], $_SESSION["user_id"]);

        echo '{"message":"followed"}';
    }

    if(
        $_POST["request"] === "deleteFollower" &&
        !empty($_POST["user_id"]) &&
        is_numeric($_POST["user_id"])
    ) {

        $model = new Follows();
        $model->deleteFollow($_POST["user_id"], $_SESSION["user_id"]);

        echo '{"message":"unfollowed"}';
    }

    // Posts

    if(
        $_POST["request"] === "deletePost" &&
        !empty($_POST["post_id"]) &&
        is_numeric($_POST["post_id"])
    ) {

        $model = new Posts();
        $post = $model->getPostById($_POST["post_id"]);

        $model->delete($_POST["post_id"]);

        $image = "images/posts/" . $post["photo"];

        unlink($image);

        echo '{"message":"deleted"}';
    }

    // Comments

    if(
        $_POST["request"] === "createComment"
    ) {

        $modelUser = new Users();
        $user = $modelUser->getById($_SESSION["user_id"]);
        
        $actualDate = strtotime(date("Y-m-d H:i:s"));
        $restrictedUntil = strtotime($user["restricted_until"]);
        $diff = $actualDate - $restrictedUntil;

        if(isset($user["restricted_until"])) {

            if( $diff < 0 ) {
                echo '{"message":"restricted_comments_user"}';
            }
        }
        else {

            if(
                $_POST["request"] === "createComment" &&
                !empty($_POST["content"]) &&
                mb_strlen($_POST["content"]) >= 10 &&
                mb_strlen($_POST["content"]) <= 222 &&
                $_SESSION["token"] === $_POST["token"]
            ) {  

                $modelComment = new Comments();
                $comment = $modelComment->createComment(
                    $_POST["content"],
                    $_POST["post_id"],
                    $_SESSION["user_id"]
                );
        
                // $modelUser = new Users();
                $user = $modelUser->getById($_SESSION["user_id"]);
        
                $username = $user["username"];
                $country = $user["country"];
                $date = date("Y-m-d H:i:s");
        
                $array = [
                    "message" => "commented",
                    "username" => $username,
                    "country" => $country,
                    "date" => $date
                ];
        
                echo json_encode($array);
            }
        }
    }

    // Replies

    if(
        $_POST["request"] === "createReply"
    ) {

        $modelUser = new Users();
        $user = $modelUser->getById($_SESSION["user_id"]);
        
        $actualDate = strtotime(date("Y-m-d H:i:s"));
        $restrictedUntil = strtotime($user["restricted_until"]);
        $diff = $actualDate - $restrictedUntil;

        if(isset($user["restricted_until"])) {

            if( $diff < 0 ) {
                echo '{"message":"restricted_replies_user"}';
            }
        }
        else {
            if(
                $_POST["request"] === "createReply" &&
                !empty($_POST["content"]) &&
                mb_strlen($_POST["content"]) >= 10 &&
                mb_strlen($_POST["content"]) <= 222 &&
                $_SESSION["token"] === $_POST["token"]
            ) {
        
                $modelComment = new Comments();
                $reply = $modelComment->createReply(
                    $_POST,
                    $_SESSION["user_id"]
                );
        
                $modelUser = new Users();
                $user = $modelUser->getById($_SESSION["user_id"]);
        
                $username = $user["username"];
                $country = $user["country"];
                $date = date("Y-m-d H:i:s");
        
                $array = [
                    "message" => "replied",
                    "username" => $username,
                    "country" => $country,
                    "date" => $date
                ];
        
                echo json_encode($array);
            }
        }
    }
}



?>