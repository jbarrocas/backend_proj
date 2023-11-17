<?php

unset($_SESSION["token"]);

if( empty($id) || !is_numeric($id) ){
    http_response_code(400);
    die("Invalid Request");
}

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {

    foreach($_POST as $key => $value) {
        $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
    }
    
    require("functions/createtoken.php");

    if(empty($_SESSION["token"])) {
        createToken();
    }

    require("models/posts.php");

    $modelPosts = new Posts();
    $post = $modelPosts->getPostById($id);

    if( empty($post) ) {
        http_response_code(404);
        die("Not found");
    }

    require("models/comments.php");
    $modelComments = new Comments();
    $comments = $modelComments->getCommentsByPostId($id);
}


require("views/postdetail.php");

?>