<?php

require("models/countries.php");

$modelCountries = new Countries();
$countries = $modelCountries->get();

$country_codes = [];
foreach($countries as $country){
    $country_codes[] = $country["country_id"];
}

$first_name = "";
$last_name = "";
$username = "";
$email = "";
$password = "";
$password_confirm = "";
$country_id = "";
$agrees = "";

require("functions/createtoken.php");

if(empty($_SESSION["token"])) {
    createToken();
}

if (isset ($_POST["send"])){

    if($_SESSION["token"] !== $_POST["token"]) {

        unset($_SESSION["token"]);

        http_response_code(401);
        die("Unauthorized");
    }
    else {

        foreach($_POST as $key => $value){
            $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }
    
        if(
            !isset($_POST["agrees"])
        ) {
            $message = "You need to agree with our terms";
        }
        else {

            $agrees = $_POST["agrees"];
    
            if(
                empty($_POST["first_name"]) ||
                empty($_POST["last_name"]) ||
                empty($_POST["username"]) ||
                empty($_POST["email"]) ||
                empty($_POST["password"]) ||
                empty($_POST["country_id"])
            ) {
                $message = "Fill in all the fields";
            }
            else {

                $first_name = $_POST["first_name"];
                $last_name = $_POST["last_name"];
                $username = $_POST["username"];
    
                if(
                    !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
                ) {
                    $message = "Insert a valid email";
                }
                else {

                    $email = $_POST["email"];
    
                    if(
                        $_POST["password"] !== $_POST["password_confirm"]
                    ) {
                        $message = "Your password does not match";
                    }
                    else {

                        $password = $_POST["password"];
                        $password_confirm = $_POST["password_confirm"];
    
                        if(
                            $_POST["captcha"] !== $_SESSION["captcha"]
                        ) {
                            $message = "Please digit the image characters correctly";
                        }
                        else {
    
                            if(
                                mb_strlen($_POST["password"]) < 8 ||
                                mb_strlen($_POST["password"]) > 1000
                            ) {
                                $message = "Your password must have at least 8 digits";
                            }
                            else {
                                
                                if(
                                    mb_strlen($_POST["username"]) < 3 ||
                                    mb_strlen($_POST["username"]) > 33 ||
                                    mb_strlen($_POST["first_name"]) < 3 ||
                                    mb_strlen($_POST["first_name"]) > 22 ||
                                    mb_strlen($_POST["last_name"]) < 2 ||
                                    mb_strlen($_POST["last_name"]) > 22
                                ) {
                                    $message = "Respect the minimum and maximum size of the names and username";
                                }
                                else {                                
    
                                    if(
                                        !in_array($_POST["country_id"], $country_codes)
                                    ) {
                                        $message = "We do not recognize this country";
                                    }
                                    else {
                                        
                                        require("models/users.php");
                                
                                        $model = new Users();
                                        $user = $model->getByUsername($_POST["username"]);
                                
                                        if(!empty($user)){
                                            $message = "This username is already taken";
                                        }
                                        else {
                                
                                            $user = $model->getByEmail($_POST["email"]);
                                
                                            if(!empty($user)) {
                                                $message = "This email already has an account";
                                            }
                                            else {

                                                require("models/user_bans.php");

                                                $modelBans = new User_Bans();
                                                $ban = $modelBans->getBanByEmail($_POST["email"]);

                                                if(!empty($ban)) {
                                                    $message = "This email belongs to a banned account. We cannot accept a new registration.";
                                                }
                                                else {

                                                    $createdUser = $model->createUser($_POST);
                                                    $_SESSION["user_id"] = $createdUser["user_id"];
    
                                                    unset($_SESSION["token"]);
                                                    unset($_SESSION["captcha"]);
                                                    http_response_code(202);
    
                                                    header("Location: /");
                                                }
                                            }
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
    }    
}

require("views/register.php");

?>