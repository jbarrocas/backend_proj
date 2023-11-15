<?php

if( empty($id) || !is_numeric($id) ){
    http_response_code(400);
    die("Invalid Request");
}


require("models/post_reports.php");

$model = new Post_Reports();
$postReport = $model->getReportById($id);

if( empty($postReport) ) {
    http_response_code(404);
    die("Not found");
}

require("views/admin_postreportdetail.php");

?>