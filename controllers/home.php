<?php

require("models/posts.php");

$modelPosts = new Posts();

$posts = $modelPosts->getRecentPosts();

require("views/home.php");

?>