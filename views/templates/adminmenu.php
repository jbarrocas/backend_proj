<figure>
    <img class="logo" src="/images/assets/PostapolAFLogoDark_400.png" alt="">
</figure>
<nav>
    <ul>
        <li><a href="/">Home</a></li>
        <li><a href="/create/">Create</a></li>
        <li><a href="/favorites/">Favorites</a></li>
        <li><a href="/mostliked/">Most Liked</a></li>
        <li><a href="/myprofile/">My Profile</a></li>
        <li><a href="/search/">Search</a></li>
        <li><a href="/dashboard/">Admin Area</a></li>
          
<?php
    if(isset($_SESSION["user_id"])){
?>
        <li><a href="/logout/">Logout</a></li>
<?php
    }
?>
    </ul>
</nav>