<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Posters</title>
    <script src="/js/likes.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        <h1>Your favorites</h1>
<?php
    require("templates/favoritePosts.php");

    if( isset($info_message) ) {
        echo '<p role="alert">' .$info_message. '</p>';
    }
?>
    </main>    
</body>
</html>