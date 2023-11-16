<?php

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
        !isset($_SESSION["is_admin"]) &&
        !isset($_SESSION["is_super_admin"])
    ) {

        http_response_code(403);
        die("Forbidden");
    }
    else {

        require("models/post_reports.php");

        $model = new Post_Reports();
        $postReport = $model->getReportById($id);

        if( empty($postReport) ) {
            http_response_code(404);
            die("Not found");
        }

        require("models/users.php");

        $modelUsers = new Users();
        $user = $modelUsers->getById($postReport["post_author"]);
    }
}

require("views/admin_postreportdetail.php");

?>