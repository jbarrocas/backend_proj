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
                <img class="logo" src="/images/assets/PaddlePicsLogoDarkMode.png" alt="PaddlePicsLogo">
                <h1 class="site-motto" >Explore, Share, Connect. The Paddler's Photo Community!</h1>
                <img class="post-pics" src="/images/assets/PicCollage_600px.png" alt="PaddlePics examples">
            </div>
            <div class="form-container">
                <form class="register-form" method="POST" action="/register/">
                    <input class="register-input" type="text" name="first_name" placeholder="First Name" required minlength="3" maxlength="22">
                    <input class="register-input" type="text" name="last_name" placeholder="Last Name" required minlength="2" maxlength="22">
                    <input class="register-input" type="text" name="username" placeholder="Username" required minlength="3" maxlength="33">
                    <input class="register-input" type="email" name="email" placeholder="Email" required>
                    <input class="register-input" type="password" name="password" placeholder="Password" required minlength="8" maxlength="1000">
                    <input class="register-input" type="password" name="password_confirm" placeholder="Password Confirm" required minlength="8" maxlength="1000">
                    <select class="register-select" name="country_id" required>
<?php
    foreach($countries as $country) {
        $selected = $country["country_id"] === "PT" ? "selected" : "";

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
                    <button class="register-button" type="submit" name="send">Sign Up</button>
                </form>
<?php
    if( isset($message) ) {
        echo '<p role="alert">' . $message . '</p>';
    }
?>
                <div class="login-button-container">
                    <p>Have an account?</p>
                    <div><a href="/login">Login</a></div>
                </div>
            </div>
        </div>
    </main>
    
</body>
</html>