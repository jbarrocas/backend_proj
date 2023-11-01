<?php

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
    
        $modelPosts = new Posts();
        $postsCount = $modelPosts->getPostsCountByUser($id);
        $recentPostsByUsers = $modelPosts->getPostsByUser($_SESSION["user_id"], $id);
    
        $modelFollows = new Follows();
        $followersCount = $modelFollows->getFollowersById($id);
        $followsCount = $modelFollows->getFollowsById($id);
        $followerCheck = $modelFollows->getFollowerByFollowed($id, $_SESSION["user_id"]);
    }    
}


require("views/profile.php");

?>