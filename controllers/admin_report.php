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
        !isset($_SESSION["is_admin"]) &&
        !isset($_SESSION["is_super_admin"])
    ) {

        http_response_code(403);
        die("Forbidden");
    }
    else {

        if( isset($_POST["submit"]) ) {

            foreach($_POST as $key => $value) {
                $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
            }
        
            if(
                !empty($_POST["adminMessage"]) &&
                mb_strlen($_POST["adminMessage"]) >= 3 &&
                mb_strlen($_POST["adminMessage"]) <= 1000
            ) {
                require("models/admin_reports.php");

                $model = new Admin_Reports();
                $model->createAdminReport($_SESSION["user_id"], $_POST["adminMessage"]);

                $message = "Report sent. Thanks for your input.";
    
                http_response_code(202);
            }
            else {
                $message = "The report must have between 3 and 1000 characters.";
            }
        }
    }
}

require("views/admin_report.php");

?>