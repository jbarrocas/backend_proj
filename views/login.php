<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Login</title>
    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-login">
    <main>
        <div class="login-container">
            <div class="logo-container">
                <img class="logo-login" src="/images/assets/PostapolAFLogoDark_400.png" alt="">
                <h1 class="site-motto" >Sharing One Picture at a Time!</h1>
                <img class="post-pics" src="/images/assets/PicCollage_600px.png" alt="Posts examples">
            </div>
            <div class="form-container">
<?php
    if( isset($message)) {
        echo ' <p id="message" role="alert">' .$message .'</p>';
    }
?>
                <form class="login-form" method="POST" action="/login/">
                    <div>
                        <input class="login-input" type="email" name="email" placeholder="Email" required>
                    </div>
                    <div>
                        <input class="login-input" type="password" name="password" placeholder="Password" required minlength="8" maxlength="1000">                        
                    </div>
                    <div>
                        <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                    </div>
                    <button class="login-button" type="submit" name="send">Log In</button>
                </form>
                <div class="forgot-password"><a href="/resetpassword/">Forgot password?</a></div>
                <div class="reg-button-container">
                    <p>Don't have an account?</p>
                    <a href="/register/"><div class="register-button">Register</div></a>
                </div>
            </div>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>