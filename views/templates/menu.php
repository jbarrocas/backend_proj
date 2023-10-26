<menu>
    <img class="logo" src="/images/assets/PaddlePicsLogoDarkMode_400px.png" alt="">
    <nav>
        <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/stroke/">Stroke a Pic</a></li>
            <li><a href="/favorite/">My Favorite Paddlers</a></li>
            <li><a href="/glide/">Glide Through</a></li>
            <li><a href="/profile/">My Profile</a></li>
          
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