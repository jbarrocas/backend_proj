<div class="menu-container">
    <figure class="logo">
        <img src="/images/assets/PostapolAFLogoDark_400.png" alt="">
    </figure>
    <nav class="menu">
        <ul id="menu-ul" data-controller="<?=$controller?>">
            <li class="menu-items" data-menu="home"><a href="/">Home</a></li>
            <li class="menu-items" data-menu="create"><a href="/create/">Create</a></li>
            <li class="menu-items" data-menu="favorites"><a href="/favorites/">Favorites</a></li>
            <li class="menu-items" data-menu="mostliked"><a href="/mostliked/">Most Liked</a></li>
            <li class="menu-items" data-menu="myprofile"><a href="/myprofile/">My Profile</a></li>
            <li class="menu-items" data-menu="search"><a href="/search/">Search</a></li>
            
    <?php
        if(isset($_SESSION["user_id"])){
    ?>
            <li class="menu-items" data-menu="logout"><a href="/logout/">Logout</a></li>
    <?php
        }
    ?>
        </ul>
    </nav>
</div>