<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <script src="/js/likes.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        <h1>My Profile</h1>
        <div>
            <div>
                <img src="/images/assets/ProfileGenericPic.png" alt="">
                <div><a href="/views/changephoto/">Change</a></div>
            </div>
            <div>
                <p ><?=$user["username"]?></p>
                <p><?=$user["country"]?></p>
                <p><?=$postsCount["posts_count"]?> posts</p>
                <div id="<?=$user["user_id"]?>">
                    <p><span id="followersNumber"><?=$followersCount["total_count"]?></span> Followers</p>
                    <p>Following <?=$followsCount["total_count"]?></p>
                    <div><a href="/views/editdetails/">Edit Details</a></div>
                </div>
            </div>
        </div>
<?php
    require("templates/userposts.php");
?>
    </main>
    
</body>
</html>