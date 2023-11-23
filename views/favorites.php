<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Favorite Posters</title>
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/likes.js"></script>
    <script src="/js/posts_buttons.js"></script>
    <script src="/js/post_delete.js"></script>
</head>
<body>
    <main>
<?php
    if(isset($_SESSION["is_admin"]) || isset($_SESSION["is_super_admin"])) {
        require("templates/adminmenu.php");
    }
    else {
        require("templates/menu.php");
    }
?>
        <div class="page-content">
            <h1 class="heading-1">Your favorites</h1>

<?php
    require("templates/posts.php");

    if( isset($info_message) ) {
        echo '<p role="alert">' .$info_message. '</p>';
    }
?>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>