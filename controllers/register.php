<?php

require("models/countries.php");

$modelCountries = new Countries();
$countries = $modelCountries->get();

$country_codes = [];
foreach($countries as $country){
    $country_codes[] = $country["country_id"];
}


if (isset ($_POST["send"])){

    foreach($_POST as $key => $value){
        $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
    }

    if(
        isset($_POST["agrees"])
    ){
        if(
            !empty($_POST["first_name"]) &&
            !empty($_POST["last_name"]) &&
            !empty($_POST["username"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["password"]) &&
            !empty($_POST["country_id"])
        ) {
            if(
                filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)
            ) {
                if(
                    $_POST["password"] === $_POST["password_confirm"]
                ) {
                    if(
                        mb_strlen($_POST["password"]) >= 8 &&
                        mb_strlen($_POST["password"]) <= 1000
                    ) {
                        if(
                            mb_strlen($_POST["first_name"]) >= 3 &&
                            mb_strlen($_POST["first_name"]) <= 22 &&
                            mb_strlen($_POST["last_name"]) >= 2 &&
                            mb_strlen($_POST["last_name"]) <= 22 &&
                            mb_strlen($_POST["username"]) >= 3 &&
                            mb_strlen($_POST["username"]) <= 33 &&
                            in_array($_POST["country_id"], $country_codes)
                        ) {
                    
                            require("models/users.php");
                    
                            $model = new Users();		
                            $user = $model->getByEmail( $_POST["email"] );
                    
                            if(empty($user)){
                    
                                $createdUser = $model->createUser($_POST);
                                $_SESSION["user_id"] = $createdUser["user_id"];
                                
                                header("Location: /");
                            }
                            else{
                                $message = "This email already has an account";
                            }
                        }
                        else{
                            $message = "Respect the size of the fields";
                        }
                    }
                    else{
                        $message = "Your password must have at least 8 digits";
                    }
                }
                else{
                    $message = "Your password does not match with the confirmation";
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
    else {
        $message = "You need to agree with our terms";
    }
}

require("views/register.php");

?>