<?php

if( empty($id) || !is_numeric($id) ){
    http_response_code(400);
    die("Request Inválido");
}


if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {

    require("models/posts.php");
    require("models/comments.php");

    $modelPosts = new Posts();
    $post = $modelPosts->getPostById($id);

    $modelComments = new Comments();
    $comments = $modelComments->getCommentsByPostId($id);

    if( isset($_POST["send_comment"])) {

        foreach($_POST as $key => $value){
            $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }

        if(
            !empty($_POST["content"]) &&
            mb_strlen($_POST["content"]) >= 3 &&
            mb_strlen($_POST["content"]) <= 222
        ) {

            $postComment = $modelComments->createComment(
                $_POST["content"],
                $id,
                $_SESSION["user_id"]
            );
        }

        $commentId = $_SESSION["comment_id"];

        header("Location: /postdetail/" . $id . ".#comment" . $commentId);
    }
}


require("views/postdetail.php");

?>