<?php

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {

    if( isset($_GET["search"]) ) {

        foreach($_GET as $key => $value) {
            $_GET[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }
    
        if(
            !empty($_GET["search"]) &&
            mb_strlen($_GET["search"]) >= 3 &&
            mb_strlen($_GET["search"]) <= 30
        ) {
            require("models/posts.php");
            $model = new Posts();
            $posts = $model->searchPosts($_SESSION["user_id"], $_GET["search"]);
    
        }
        else {
            $message = "Insert text in the search field";
        }
    }
}



require("views/search.php");

?>