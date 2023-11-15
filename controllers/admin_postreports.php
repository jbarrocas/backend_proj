<?php

require("models/post_reports.php");

$model = new Post_Reports();
$postReports = $model->getReports();

require("views/admin_postreports.php");

?>