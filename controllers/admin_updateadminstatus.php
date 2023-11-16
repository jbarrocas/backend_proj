<?php

$selectOptions = ["true", "false"];

require("functions/createtoken.php");

if(empty($_SESSION["token"])) {
    createToken();
}

if( empty($id) || !is_numeric($id) ){
    http_response_code(400);
    die("Invalid Request");
}

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

        require("models/users.php");

        $model = new Users();
        $admin = $model->getById($id);

        if( empty($admin) ) {
            http_response_code(404);
            die("Not found");
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
                    empty($_POST["is_admin"]) &&
                    empty($_POST["is_super_admin"])
                ) {
                    $message = "Choose the option in both select boxes.";
                }
                else {
                    
                    $updateStatus = $model->updateAdminStatus($_POST, $id);

                    header("Location: /admin_updateadminstatus/$id");
                }
            }    
        }
    }
}

require("views/admin_updateadminstatus.php");

?>