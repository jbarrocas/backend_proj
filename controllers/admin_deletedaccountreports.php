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

        require("models/deleteaccountreports.php");
        $modelReports = new Delete_Reports();
        $weekReports = $modelReports->getReportsOfLastWeek();

        $numberOfRows = count($weekReports);

        $weekStatistics = $modelReports->getCountBySubjectLastWeek();

        $monthReports = $modelReports->getReportsOfLastMonth();

        $numberOfRowsMonth = count($monthReports);

        $monthStatistics = $modelReports->getCountBySubjectLastMonth();

        $reports = $modelReports->getReportsWithText();
        
    }
}

require("views/admin_deleteaccountreports.php");

?>