<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <script src="/js/profile.js"></script>
    <script src="/js/likes.js"></script>
</head>
<body>
    <main>
<?php
    require("templates/menu.php");
?>
        <h1>Profile</h1>
        <div>
            <img src="/images/users/<?=$user["photo"]?>" alt="">
            <div>
                <p ><?=$user["username"]?></p>
                <p><?=$user["country"]?></p>
                <p><?=$postsCount["posts_count"]?> posts</p>
                <div data-user_id="<?=$user["user_id"]?>">
                    <p><span id="followersNumber"><?=$followersCount["total_count"]?></span> Followers</p>
                    <p>Following <?=$followsCount["total_count"]?></p>
                    <button id="followBtn" type="button" data-user="<?= $followerCheck ?>" name="follow" aria-label="Follow">Follow</button>
                </div>
            </div>
        </div>
<?php
    require("templates/userposts.php");
?>
    </main>
    
</body>
</html>