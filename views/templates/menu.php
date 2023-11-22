<div class="menu-container">
    <figure class="logo">
        <img src="/images/assets/PostapolAFLogoDark_400.png" alt="">
    </figure>
    <nav class="menu">
        <ul class="menu-ul">
            <li class="menu-items"><a href="/">Home</a></li>
            <li class="menu-items"><a href="/create/">Create</a></li>
            <li class="menu-items"><a href="/favorites/">Favorites</a></li>
            <li class="menu-items"><a href="/mostliked/">Most Liked</a></li>
            <li class="menu-items"><a href="/myprofile/">My Profile</a></li>
            <li class="menu-items"><a href="/search/">Search</a></li>
            
    <?php
        if(isset($_SESSION["user_id"])){
    ?>
            <li><a href="/logout/">Logout</a></li>
    <?php
        }
    ?>
        </ul>
    </nav>
</div>