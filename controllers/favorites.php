<?php

require("models/users.php");

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {
    require("models/posts.php");

    $model = new Posts();
    $favoritePosts = $model->getPostsByFollower($_SESSION["user_id"], $_SESSION["user_id"]);

    if(empty($favoritePosts)) {
        
        $info_message = "You do not follow anyone.";
    }
}

require("views/favorites.php");

?>