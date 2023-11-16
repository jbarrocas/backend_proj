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

        require("models/users.php");

        $model = new Users();
        $is_admin = "true";
        $admins = $model->getAdmins($is_admin);        
    }
}

require("views/admin_list.php");

?>