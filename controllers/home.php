<?php

require("models/posts.php");

$modelPosts = new Posts();

$posts = $modelPosts->getPosts();

require("views/home.php");

?>