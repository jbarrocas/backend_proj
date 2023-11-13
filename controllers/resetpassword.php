<?php

if( isset($_POST["reset_password"]) ) {

    foreach($_POST as $key => $value) {
        $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
    }

    $token = bin2hex(random_bytes(32));

    $email = $_POST["email"];

    $url = "http://localhost/createnewpassword/?token=" . $token . "&email=" . $email;

    $expires_at = time() + (30 * 60);

    require("models/users.php");
    $modelUsers = new Users();
    $user = $modelUsers->getByEmail($email);

    if(empty($user)) {

        $message = "We do not have an account with this email";
    }
    else {

        require("models/password_resets.php");
        $modelPasswordReset = new Password_Resets();
        $reset = $modelPasswordReset->getPasswordReset($email);

        if(empty($reset)) {

            $modelPasswordReset->createPasswordReset($email, $token, $expires_at);
        }
        else {

            $modelPasswordReset->deletePasswordReset($email);
            $modelPasswordReset->createPasswordReset($email, $token, $expires_at);

            $subject = 'Reset your passord for Postapol';
        
            $message = '<p>To reset your password click in the link below.</p>
                        <div><a href="' .$url. '">Click here to reset your password.</a></div>';

            require("functions/sendemail.php");
            sendEmail($_POST["email"], $user["first_name"], $user["last_name"], $subject, $message);

            $message = "Email sent. Check your email.";
        }        
    }
}

require("views/resetpassword.php");

?>