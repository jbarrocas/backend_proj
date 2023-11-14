<?php

if(
    !isset($_SESSION["admin_id"]) && isset($_SESSION["user_id"])
) {

    http_response_code(403);
    die("Forbidden");
}
else {

    if(
        !isset($_SESSION["admin_id"]) && !isset($_SESSION["user_id"])
    ) {

        http_response_code(401);
        die("Unauthorized");
    }
    else {

        require("models/admins.php");
        $model = new Admins();
        $admin = $model->getById($_SESSION["admin_id"]);
    }
}

require("views/dashboard.php");

?>