<?php

require("models/report_subjects.php");

$modelReportSubjects = new Report_Subjects();
$subjects = $modelReportSubjects->get();

require("models/comments.php");
$modelComments = new Comments();
$comment = $modelComments->getCommentById($id);

$reportsSubjects = [];
foreach($subjects as $subject){
    $reportsSubjects[] = $subject["report_subject_id"];
}

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");
}
else {

    if( empty($id) || !is_numeric($id) ){
        http_response_code(400);
        die("Invalid Request");
    }

    if( empty($comment)) {
        http_response_code(404);
        die("Not Found");
    }

    if(isset($_POST["send"])) {

        if(
            !empty($_POST["subject"]) &&
            in_array($_POST["subject"], $reportsSubjects)
        ) {

            require("models/comments_reports.php");
            $model = new Comments_Reports();
            $model->createReport($id, $_SESSION["user_id"], $_POST["subject"], $comment["comment_author"]);

            $message = "Report sent. Thanks for your cooperation.";
            http_response_code(202);
        }
        else {
            $message = "Choose a subject for report";
        }
    }
}

require("views/report_comment.php");

?>