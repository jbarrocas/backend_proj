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

    if( empty($post) ) {
        http_response_code(404);
        die("Not found");
    }
}


require("views/postdetail.php");

?>