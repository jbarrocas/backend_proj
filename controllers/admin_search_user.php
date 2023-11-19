<?php

if(
    !isset($_SESSION["user_id"])
) {

    http_response_code(401);
    die("Unauthorized");
}
else {

    if(
        isset($_SESSION["user_id"]) &&
        isset($_SESSION["is_admin"]) ||
        !isset($_SESSION["is_super_admin"])
    ) {

        http_response_code(403);
        die("Forbidden");
    }
    else {

        if( isset($_GET["search"]) ) {

            foreach($_GET as $key => $value) {
                $_GET[ $key ] = htmlspecialchars(strip_tags(trim($value)));
            }
        
            if(
                !empty($_GET["search"]) &&
                mb_strlen($_GET["search"]) >= 3 &&
                mb_strlen($_GET["search"]) <= 30
            ) {
                require("models/users.php");

                $model = new Users();
                $users = $model->searchUser($_GET["search"]);      
    
                http_response_code(202);
    
                if(empty($users)) {
    
                    http_response_code(404);
                    $message = "No results were found.";
                }
            }
            else {
                $message = "The search must include between 3 and 30 characters.";
            }
        }
    }
}

require("views/admin_search_user.php");

?>