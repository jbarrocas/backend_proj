<?php

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");
}
else {

    require("models/users.php");
    $model = new Users();
    $user = $model->getById($_SESSION["user_id"]);

    if( isset($_POST["send"]) ) {

        foreach($_POST as $key => $value) {
            $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }

        if(
            !empty($_POST["old_password"]) &&
            !empty($_POST["new_password"]) &&
            !empty($_POST["new_password_confirm"])
        ) {

            if(
                $_POST["new_password"] === $_POST["new_password_confirm"]
            ) {

                if(
                    mb_strlen($_POST["old_password"]) >= 8 &&
                    mb_strlen($_POST["old_password"]) <= 1000 &&
                    mb_strlen($_POST["new_password"]) >= 8 &&
                    mb_strlen($_POST["new_password"]) <= 1000 &&
                    mb_strlen($_POST["new_password_confirm"]) >= 8 &&
                    mb_strlen($_POST["new_password_confirm"]) <= 1000
                ) {

                    if (
                        !empty($_SESSION["user_id"]) &&
                        password_verify($_POST["old_password"], $user["password"])                
                    ) {

                        $model->updatePassword($_POST, $_SESSION["user_id"]);
                        http_response_code(202);

                        header("Location: /myprofile/");
                    }
                    else {
                        $message = "Old password incorrect.";
                    }
                }
                else {
                    $message = "Password must have at least 8 digits";
                }
            }
            else {
                $message = "Your new password does not match with the confirmation";
            }
        }
        else {
            $message = "Fill in all the fields";
        }
    }
}

require("views/updatepassword.php");

?>