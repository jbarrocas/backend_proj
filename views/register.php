<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <link rel="stylesheet" href="/css/main.css">
</head>
<body class="body-register">
    <main>
        <div class="register-container">
            <div class="logo-container">
                <img class="logo-login" src="/images/assets/PostapolAFLogoDark_400.png" alt="">
                <h1 class="site-motto" >Sharing One Picture at a Time!</h1>
                <img class="post-pics" src="/images/assets/PicCollage_600px.png" alt="Postapol examples">
            </div>
            <div class="form-container">
                <form class="register-form" method="POST" action="/register/">
                    <div>
                        <input class="register-input" type="text" name="first_name" placeholder="First Name" aria-label="First Name" value="<?= $first_name ?>" required minlength="3" maxlength="22">
                    </div>
                    <div>
                        <input class="register-input" type="text" name="last_name" placeholder="Last Name" aria-label="Last Name" value="<?= $last_name ?>" required minlength="2" maxlength="22">
                    </div>
                    <div>
                        <input class="register-input" type="text" name="username" placeholder="Username" aria-label="Username" value="<?= $username ?>" required minlength="3" maxlength="33">
                    </div>
                    <div>
                        <input class="register-input" type="email" name="email" placeholder="Email" aria-label="Email" value="<?= $email ?>" required>
                    </div>
                    <div>
                        <input class="register-input" type="password" name="password" placeholder="Password" aria-label="Password" value="<?= $password ?>" required minlength="8" maxlength="1000">
                    </div>
                    <div>
                        <input class="register-input" type="password" name="password_confirm" placeholder="Password Confirmation" aria-label="Password Confirmation" value="<?= $password_confirm ?>" required minlength="8" maxlength="1000">
                    </div>
                    <div>
                    <input type="hidden" name="token" value="<?= $_SESSION["token"] ?>">
                    </div>
                    <div>
                    <select class="register-select" name="country_id" aria-label="Country" required>
<?php
    foreach($countries as $country) {
        $selected = $country["country_id"] === "US" ? " selected" : "";

        echo '
            <option value="' .$country["country_id"]. '"' .$selected. '>' .$country["name"]. '</option>
        ';
    }
?>
                    </select>
                    </div>
                    <div>
                        <label>
                        <input type="checkbox" name="agrees" required>
                            Agree to our Terms?
                        </label>  
                    </div>
                    <div>
                        <img class="captcha" src="../functions/captcha.php" alt="">
                    </div>
                    <div>
                        <input class="register-input" type="text" name="captcha" aria-label="Captcha" placeholder="Digit the image characters" required>
                    </div>
                    <button class="register-button" type="submit" name="send">Sign Up</button>
                </form>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' . $message . '</p>';
    }
?>
                <div class="login-button-container">
                    <p>Have an account?</p>
                    <a href="/login/"><div class="login-button" >Login</div></a>
                </div>
            </div>
        </div>
<?php
    require("templates/footer.php");
?>
    </main>    
</body>
</html>