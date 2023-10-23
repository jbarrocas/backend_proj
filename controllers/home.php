<?php

require("models/users.php");

$modelUsers = new Users();
$user = $modelUsers->getByEmail($_POST["email"]);
$_SESSION["user_id"] = $user["user_id"];

if(!isset($_SESSION["user_id"])) {

    header("Location:" .ROOT.  "/login/");

}
else {
    require("models/posts.php");

    $modelPosts = new Posts();
    $posts = $modelPosts->getRecentPosts();
}

require("views/home.php");

?>