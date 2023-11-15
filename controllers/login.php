<?php

require("functions/createtoken.php");

if(empty($_SESSION["token"])) {
    createToken();
}

if( isset($_POST["send"]) ) {

    if($_SESSION["token"] !== $_POST["token"]) {

        unset($_SESSION["token"]);

        http_response_code(401);
        die("Unauthorized");
    }
    else {

        foreach($_POST as $key => $value) {
            $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }
    
        if(
            !empty($_POST["email"]) &&
            !empty($_POST["password"]) &&
            filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
            mb_strlen($_POST["password"]) >= 8 &&
            mb_strlen($_POST["password"]) <= 1000
        ) {
            require("models/users.php");
            $modelUsers = new Users();
            $user = $modelUsers->getByEmail($_POST["email"]);

            require("models/admins.php");
            $modelAdmins = new Admins();
            $admin = $modelAdmins->getByEmail($_POST["email"]);
    
            if(
                !empty($user) &&
                empty($admin) &&
                password_verify($_POST["password"], $user["password"])
            ) {
                $_SESSION["user_id"] = $user["user_id"];
                unset($_SESSION["token"]);
                header("Location: /");
            }
            else {

                if(
                    !empty($admin) &&
                    !empty($user) &&
                    password_verify($_POST["password"], $admin["password"])
                ) {
                    $_SESSION["admin_id"] = $admin["admin_id"];
                    $_SESSION["user_id"] = $user["user_id"];
                    unset($_SESSION["token"]);
                    header("Location: /dashboard/");
                }
                else {
                    $message = "Email or Password incorrect";
                }
            }
        }
        else {
            $message = "Complete the form correctly";
        }
    }
}

require("views/login.php");

?>