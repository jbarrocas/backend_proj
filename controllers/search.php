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

            http_response_code(202);

            if(empty($posts)) {

                http_response_code(404);
                $message = "No results were found.";
            }
        }
        else {
            $message = "The search must include between 3 and 30 characters.";
        }
    }
}

require("views/search.php");

?>