<menu>
    <img class="logo" src="/images/assets/PostapolAFLogoDark_400.png" alt="">
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/create/">Create</a></li>
            <li><a href="/favorite/">Favorites</a></li>
            <li><a href="/explore/">Explore</a></li>
            <li><a href="/profile/">Profile</a></li>
          
<?php
    if(isset($_SESSION["user_id"])){
?>
            <li><a href="/logout/">Terminar Sessão</a></li>
<?php
    }
?>
        </ul>
    </nav>
</menu>