<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <main>
        <div class="register-container">
            <div class="logo-container">
                <img class="logo" src="/images/assets/PostapolAFLogoDark_400.png" alt="">
                <h1 class="site-motto" >Sharing One Picture at a Time!</h1>
                <img class="post-pics" src="/images/assets/PicCollage_600px.png" alt="Postapol examples">
            </div>
            <div class="form-container">
                <form class="register-form" method="POST" action="/register/">
                    <input class="register-input" type="text" name="first_name" placeholder="First Name" value="<?= $first_name ?>" required minlength="3" maxlength="22">
                    <input class="register-input" type="text" name="last_name" placeholder="Last Name" value="<?= $last_name ?>" required minlength="2" maxlength="22">
                    <input class="register-input" type="text" name="username" placeholder="Username" value="<?= $username ?>" required minlength="3" maxlength="33">
                    <input class="register-input" type="email" name="email" placeholder="Email" value="<?= $email ?>" required>
                    <input class="register-input" type="password" name="password" placeholder="Password" value="<?= $password ?>" required minlength="8" maxlength="1000">
                    <input class="register-input" type="password" name="password_confirm" placeholder="Password Confirm" value="<?= $password_confirm ?>" required minlength="8" maxlength="1000">
                    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                    <select class="register-select" name="country_id" required>
<?php
    foreach($countries as $country) {
        $selected = $country["country_id"] === "US" ? " selected" : "";

        echo '
            <option value="' .$country["country_id"]. '"' .$selected. '>' .$country["name"]. '</option>
        ';
    }
?>
                    </select>
                    <label>
                    <input type="checkbox" name="agrees" required>
                        Agree to our Terms?
                    </label>
                    <img src="../functions/captcha.php" alt="">
                    <input class="register-input" type="text" name="captcha" placeholder="Digit the image characters" required>
                    <button class="register-button" type="submit" name="send">Sign Up</button>
                </form>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' . $message . '</p>';
    }
?>
                <div class="login-button-container">
                    <p>Have an account?</p>
                    <div><a href="/login/">Login</a></div>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>