<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Most Liked Posts</title>
    <script src="/js/likes.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        <h1>Most Liked Posts</h1>
<?php
    require("templates/mostLikedPosts.php");
?>
    </main>    
</body>
</html>