<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile - <?= $user["username"] ?></title>
    <link rel="stylesheet" href="/css/main.css">
    <script src="/js/likes.js"></script>
    <script src="/js/post_delete.js"></script>
    <script src="/js/posts_buttons.js"></script>
    <script src="/js/myprofile.js"></script>
    <script src="/js/see_more_btn.js"></script>

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
            <h1 class="heading-1">My Profile</h1>
            <div class="profile-container">
                <div class="photo-container">
                    <figure>
                        <img class="user-photo" id="userPhoto" src="/images/users/<?=$user["photo"]?>" alt="">
                    </figure>
                    <a href="/updatephoto/"><div class="change-photo">Change Photo</div></a>
                </div>
                <div class="details-container">
                    <p class="username"><?=$user["username"]?></p>
                    <p class="country"><?=$user["country"]?></p>
                    <p class="posts-count">Posts <span id="postsCount"><?=$postsCount["posts_count"]?></span></p>
                    <div class="profile-action" data-user_id="<?=$user["user_id"]?>">
                        <p class="followers">Followers <span id="followersNumber"><?=$followersCount["total_count"]?></span></p>
                        <p class="following">Following <?=$followsCount["total_count"]?></p>
                        <a href="/updatedetails/"><div class="update-details">Update Details</div></a>
                        <a href="/deleteaccount/"><div class="delete-account">Delete Account</div></a>
                    </div>
                </div>
            </div>
<?php
    require("templates/posts.php");
?>
            <form action="/myprofile/<?=$user["user_id"]?>/" method="get" class="see-more">
                <input type="hidden" data-last_page="<?= $pages_number ?>">
                <button class="see-more-button" type="submit" name="page_number" data-limit="<?=$limit?>" data-posts="<?=$postsCount["posts_count"]?>" value="<?= $next_page ?>">See More Posts</button>
            </form>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>
    
</body>
</html>