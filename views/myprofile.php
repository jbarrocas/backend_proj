<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - <?= $user["username"] ?></title>
    <script src="/js/likes.js"></script>
    <script src="/js/posts.js"></script>

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
        <h1>My Profile</h1>
        <div>
            <div>
                <img id="userPhoto" src="/images/users/<?=$user["photo"]?>" alt="">
                <div><a href="/updatephoto/">Change</a></div>
            </div>
            <div>
                <p ><?=$user["username"]?></p>
                <p><?=$user["country"]?></p>
                <p><?=$postsCount["posts_count"]?> posts</p>
                <div data-user_id="<?=$user["user_id"]?>">
                    <p><span id="followersNumber"><?=$followersCount["total_count"]?></span> Followers</p>
                    <p>Following <?=$followsCount["total_count"]?></p>
                    <div><a href="/updatedetails/">Update Details</a></div>
                    <div><a href="/deleteaccount/">Delete Account</a></div>
                </div>
            </div>
        </div>
<?php
    require("templates/ownedposts.php");
?>
    </main>
    
</body>
</html>