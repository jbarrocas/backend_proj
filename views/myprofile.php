<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - <?= $user["username"] ?></title>
    <script src="/js/likes.js"></script>
    <script src="/js/post_delete.js"></script>
    <script src="/js/posts_buttons.js"></script>
    <script src="/js/myprofile.js"></script>

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
                <figure>
                    <img id="userPhoto" src="/images/users/<?=$user["photo"]?>" alt="">
                </figure>
                <div><a href="/updatephoto/">Change</a></div>
            </div>
            <div>
                <p ><?=$user["username"]?></p>
                <p><?=$user["country"]?></p>
                <p>Posts <span id="postsCount"><?=$postsCount["posts_count"]?></span></p>
                <div data-user_id="<?=$user["user_id"]?>">
                    <p>Followers <span id="followersNumber"><?=$followersCount["total_count"]?></span></p>
                    <p>Following <?=$followsCount["total_count"]?></p>
                    <div><a href="/updatedetails/">Update Details</a></div>
                    <div><a href="/deleteaccount/">Delete Account</a></div>
                </div>
            </div>
        </div>
<?php
    require("templates/posts.php");
?>
<?php
    require("templates/footer.php");
?>
    </main>
    
</body>
</html>