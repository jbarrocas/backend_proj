<?php

if( empty($id) || !is_numeric($id) ){
    http_response_code(400);
    die("Invalid Request");
}


if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {

    require("models/posts.php");
    require("models/comments.php");

    $modelPosts = new Posts();
    $post = $modelPosts->getPostById($id);

    if( empty($post) ) {
        http_response_code(404);
        die("Not found");
    }

    $modelComments = new Comments();
    $comments = $modelComments->getCommentsByPostId($id);

    if( isset($_POST["send_comment"])) {

        foreach($_POST as $key => $value){
            $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }

        if(
            !empty($_POST["content"]) &&
            mb_strlen($_POST["content"]) >= 10 &&
            mb_strlen($_POST["content"]) <= 222
        ) {

            $comment_id = $modelComments->createComment(
                $_POST["content"],
                $id,
                $_SESSION["user_id"]
            );

            // tirar isto e fazer AJAX
            header("Location: /postdetail/" . $id . ".#comment" . $comment_id);
        }
        else {
            $message = "The comment must have between 10 and 222 characters";
        }
    }
}


require("views/postdetail.php");

?>