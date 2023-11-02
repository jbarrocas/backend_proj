<?php

require("models/countries.php");
require("models/users.php");

$modelCountries = new Countries();
$countries = $modelCountries->get();

$country_codes = [];
foreach($countries as $country){
    $country_codes[] = $country["country_id"];
}

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");
}
else {

    $model = new Users();
    $user = $model->getById($_SESSION["user_id"]);
    
    
    if (isset ($_POST["send"])){
    
        foreach($_POST as $key => $value){
            $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }
    
        if(
            !empty($_POST["first_name"]) &&
            !empty($_POST["last_name"]) &&
            !empty($_POST["email"]) &&
            !empty($_POST["country_id"]) &&
            filter_var($_POST["email"], FILTER_VALIDATE_EMAIL) &&
            mb_strlen($_POST["first_name"]) >= 3 &&
            mb_strlen($_POST["first_name"]) <= 22 &&
            mb_strlen($_POST["last_name"]) >= 2 &&
            mb_strlen($_POST["last_name"]) <= 22 &&
            in_array($_POST["country_id"], $country_codes)
        ) {
        
    		$userdetails = $model->updateDetails( $_POST, $_SESSION["user_id"] );
        
            header("Location: /myprofile/");
        
    	}
        else{
            $message = "Complete the form correctly";
        }
    }
}

require("views/editdetails.php");

?>