<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile - <?= $user["username"] ?></title>
    <script src="/js/profile.js"></script>
    <script src="/js/likes.js"></script>
    <script src="/js/posts_buttons.js"></script>
    <script src="/js/home.js"></script>
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
        <h1>Profile</h1>
        <div>
            <img src="/images/users/<?=$user["photo"]?>" alt="">
            <div>
                <p ><?=$user["username"]?></p>
                <p><?=$user["country"]?></p>
                <p>Posts <?=$postsCount["posts_count"]?></p>
                <div data-user_id="<?=$user["user_id"]?>">
                    <p>Followers <span id="followersNumber"><?=$followersCount["total_count"]?></span></p>
                    <p>Following <?=$followsCount["total_count"]?></p>
                    <button id="followBtn" type="button" data-user="<?= $followerCheck ?>" name="follow">Follow</button>
                </div>
            </div>
        </div>
<?php
    require("templates/posts.php");
?>
        <form action="/profile/<?=$user["user_id"]?>/" method="get">
            <input type="hidden" data-last_page="<?= $pages_number ?>">
            <button type="submit" name="page_number" value="<?= $next_page ?>">See More</button>
        </form>
<?php
    require("templates/footer.php");
?>
    </main>
    
</body>
</html>