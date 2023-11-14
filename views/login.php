<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <main>
        <div class="login-container">
            <div class="logo-container">
                <img class="logo" src="/images/assets/PostapolAFLogoDark_400.png" alt="">
                <h1 class="site-motto" >Sharing One Picture at a Time!</h1>
                <img class="post-pics" src="/images/assets/PicCollage_600px.png" alt="Posts examples">
            </div>
            <div class="form-container">
                <form class="login-form" method="POST" action="/login/">
                    <input class="login-input" type="email" name="email" placeholder="Email" required>
                    <input class="login-input" type="password" name="password" placeholder="Password" required minlength="8" maxlength="1000">
                    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                    <button class="login-button" type="submit" name="send">Log In</button>
                    <div><a href="/resetpassword/">Forgot password?</a></div>
                </form>
                <div class="reg-button-container">
                    <p>Don't have an account?</p>
                    <div><a href="/register/">Register</a></div>
                </div>
            </div>
        </div>
    </main>    
</body>
</html>