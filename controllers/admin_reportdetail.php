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
        isset($_SESSION["is_admin"]) ||
        !isset($_SESSION["is_super_admin"])
    ) {

        http_response_code(403);
        die("Forbidden");
    }
    else {

        require("models/admin_reports.php");

        $modelReports = new Admin_Reports();
        $report = $modelReports->getReportById($id);

        if( empty($report) ) {
            http_response_code(404);
            die("Not found");
        }

        if(isset($_POST["archive"])) {

            $modelReports->updateAdminReport($_SESSION["user_id"], $report["admin_report_id"]);

            $message = "Report archived.";
        }
    }
}

require("views/admin_reportdetail.php");

?>