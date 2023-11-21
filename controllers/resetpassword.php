<?php

if( isset($_POST["reset_password"]) ) {

    foreach($_POST as $key => $value) {
        $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
    }

    $token = bin2hex(random_bytes(32));

    $email = $_POST["email"];

    $url = "http://". ENV["ROOT"] ."/createnewpassword/?token=" . $token . "&email=" . $email;

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

            $modelPasswordReset->createPasswordReset($email, $token);

            $subject = 'Reset your password for Postapol';
        
            $message = '<p>To reset your password click in the link below.</p>
                        <div><a href="' .$url. '">Click here to reset your password.</a></div>';

            require("functions/sendemail.php");
            sendEmail($_POST["email"], $user["first_name"], $user["last_name"], $subject, $message);

            $message = "Email sent. Check your email.";
            http_response_code(202);
        }
        else {

            $actual_date = strtotime(date("Y/m/d H:i:s"));

            $timeWindow = (strtotime($reset["created_at"]) + (30 * 60));

            if(
                $actual_date <= $timeWindow
            ) {

                $message = "We've already sent you a link to reset your password. Check your email box.";
            }
            else {

                $modelPasswordReset->deletePasswordReset($email);
                $modelPasswordReset->createPasswordReset($email, $token);
    
                $subject = 'Reset your password for Postapol';
            
                $message = '<p>To reset your password click in the link below.</p>
                            <div><a href="' .$url. '">Click here to reset your password.</a></div>';
    
                require("functions/sendemail.php");
                sendEmail($_POST["email"], $user["first_name"], $user["last_name"], $subject, $message);
    
                $message = "Email sent. Check your email.";
                http_response_code(202);
            }
        }        
    }
}

require("views/resetpassword.php");

?>