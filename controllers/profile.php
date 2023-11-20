<?php

if( empty($id) || !is_numeric($id) ){
    http_response_code(400);
    die("Invalid Request");
}

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");

}
else {

    if($_SESSION["user_id"] == $id) {

        header("Location:/myprofile/");
    }
    else {

        require("models/users.php");
        require("models/posts.php");
        require("models/follows.php");
    
        $modelUser = new Users();
        $user = $modelUser->getById($id);

        if( empty($user) ) {
            http_response_code(404);
            die("Not found");
        }
    
        $modelPosts = new Posts();
        $postsCount = $modelPosts->getPostsCountByUser($id);
        $posts = $modelPosts->getPostsByUser($_SESSION["user_id"], $id);
    
        $modelFollows = new Follows();
        $followersCount = $modelFollows->getFollowersById($id);
        $followsCount = $modelFollows->getFollowsById($id);
        $followerCheck = $modelFollows->getFollowerByFollowed($id, $_SESSION["user_id"]);
    }    
}


require("views/profile.php");

?>