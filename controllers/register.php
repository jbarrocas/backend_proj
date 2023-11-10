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

require("functions/inputData.php");


if (isset ($_POST["send"])){

    foreach($_POST as $key => $value){
        $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
    }

    if(
        isset($_POST["agrees"])
    ) {
        $agrees = inputData($_POST["agrees"]);

        if(
            !empty($_POST["first_name"]) &&
            !empty($_POST["last_name"]) &&
            !empty($_POST["username"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["password"]) &&
            !empty($_POST["country_id"])
        ) {
            $first_name = inputData($_POST["first_name"]);
            $last_name = inputData($_POST["last_name"]);
            $username = inputData($_POST["username"]);

            if(
                filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
            ) {
                $email = inputData($_POST["email"]);

                if(
                    $_POST["password"] === $_POST["password_confirm"]
                ) {
                    $password = inputData($_POST["password"]);
                    $password_confirm = inputData($_POST["password_confirm"]);

                    if(
                        $_POST["captcha"] === $_SESSION["captcha"]
                    ) {

                        if(
                            mb_strlen($_POST["password"]) >= 8 &&
                            mb_strlen($_POST["password"]) < 1000
                        ) {
                            
                            if(
                                mb_strlen($_POST["username"]) >= 3 &&
                                mb_strlen($_POST["username"]) < 33 &&
                                mb_strlen($_POST["first_name"]) >= 3 &&
                                mb_strlen($_POST["first_name"]) < 22 &&
                                mb_strlen($_POST["last_name"]) >= 2 &&
                                mb_strlen($_POST["last_name"]) < 22
                            ) {                                

                                if(
                                    in_array($_POST["country_id"], $country_codes)
                                ) {
                                    
                                    require("models/users.php");
                            
                                    $model = new Users();
                                    $user = $model->getByUsername($_POST["username"]);
                            
                                    if(empty($user)) {
                            
                                        $user = $model->getByEmail( $_POST["email"] );
                            
                                        if(empty($user)) {
                            
                                            $createdUser = $model->createUser($_POST);
                                            $_SESSION["user_id"] = $createdUser["user_id"];
                            
                                            header("Location: /");
                                        }
                                        else{
                                            $message = "This email already has an account";
                                        }
                                    }
                                    else{
                                        $message = "This username is already taken";
                                    }
                                }
                                else{
                                    $message = "We do not recognize this country";
                                }
                            }
                            else{
                                $message = "Respect the minimum and maximum size of the names and username";
                            }
                        }
                        else{
                            $message = "Your password must have at least 8 digits";
                        }
                    }
                    else{
                        $message = "Please digit the image carachters correctly";
                    }
                }
                else{
                    $message = "Your password does not match";
                }
            }
            else{
                $message = "Insert a valid email";
            }
        }
        else{
            $message = "Fill in all the fields";
        }
    }
    else{
        $message = "You need to agree with our terms";
    }
}

require("views/register.php");

?>