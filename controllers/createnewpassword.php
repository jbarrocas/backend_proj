<?php

require("models/users.php");
require("models/password_resets.php");

if( isset($_POST["createpassword"]) ) {

    foreach($_POST as $key => $value) {
        $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
    }

    $email = $_GET["email"];
    $token = $_GET["token"];

    if(
        empty($email) && empty($token)
    ) {

        http_response_code(400);
        die("Bad Request");
    }
    else {
    
        $model = new Users();
        $user = $model->getByEmail($email);
    
        $modelResets = new Password_Resets();
        $reset = $modelResets->getPasswordReset($email);
    
        if(!isset($reset)) {
    
            http_response_code(404);
            die("Not Found");
        }
        else {
    
            $actual_date = strtotime(date("Y/m/d H:i:s"));

            $timeWindow = (strtotime($reset["created_at"]) + (30 * 60));
    
            if(
                $actual_date > $timeWindow ||
                !password_verify($token, $reset["token"])
            ) {
                $message = "Invalid token. Ask for a new one <a href='/resetpassword/'>here</a>.";
            }
            else {
    
                if(
                    empty($_POST["new_password"]) ||
                    empty($_POST["new_password_confirm"])
                ) {
                    $message = "Fill in all the fields";
                }
                else {
            
                    if(
                        $_POST["new_password"] !== $_POST["new_password_confirm"]
                    ) {
                        $message = "Your new password does not match with the confirmation";
                    }
                    else {
            
                        if(
                            mb_strlen($_POST["new_password"]) < 8 ||
                            mb_strlen($_POST["new_password"]) > 1000 ||
                            mb_strlen($_POST["new_password_confirm"]) < 8 ||
                            mb_strlen($_POST["new_password_confirm"]) > 1000
                        ) {
                            $message = "Password must have at least 8 digits";
                        }
                        else {
                            $model = new Users();
                            $model->updatePassword($_POST, $user["user_id"]);

                            $modelResets->deletePasswordReset($_GET["email"]);

                            $_SESSION["user_id"] = $user["user_id"];

                            http_response_code(201);
            
                            header("Location: /");
                        }
                    }
                }
            }
        }
    }
}

require("views/createnewpassword.php");

?>