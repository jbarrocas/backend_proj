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
    
        $modelFollows = new Follows();
        $followersCount = $modelFollows->getFollowersById($id);
        $followsCount = $modelFollows->getFollowsById($id);
        $followerCheck = $modelFollows->getFollowerByFollowed($id, $_SESSION["user_id"]);

        $limit = 3;
        $offset = 0;
    
        $posts_number = $postsCount["posts_count"];
    
        $pages_number = intval(ceil($posts_number / $limit));

        if(
            isset($_GET["page_number"]) &&
            is_numeric($_GET["page_number"])
            ) {
                htmlspecialchars(strip_tags(trim($_GET["page_number"])));
    
                $page_number = intval($_GET["page_number"]);
            }
        else {
            $page_number = 1;
        }
    
        if($page_number < 1 || $page_number > $pages_number) {
    
            $page_number = 1;
        }
    
        $offset = ($page_number - 1) * $limit;

        $posts = $modelPosts->getPostsByUser($_SESSION["user_id"], $id, $limit, $offset);

        if($page_number != $pages_number) {
            $next_page = $page_number + 1;
        }
        else {
            $page_number = 1;
            $next_page = $page_number;
        }
    }    
}

require("views/profile.php");

?>