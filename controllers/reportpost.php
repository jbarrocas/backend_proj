<?php

require("models/report_subjects.php");

$modelReportSubjects = new Report_Subjects();
$subjects = $modelReportSubjects->get();

require("models/posts.php");
$modelPosts = new Posts();
$post = $modelPosts->getPostById($id);


$reportsSubjects = [];
foreach($subjects as $subject){
    $reportsSubjects[] = $subject["name"];
}

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");
}
else {

    if(isset($_POST["send"])) {

        if(
            !empty($_POST["subject"]) &&
            in_array($_POST["subject"], $reportsSubjects)
        ) {

            require("models/reports.php");
            $model = new Reports();
            $model->createReport($id, $_SESSION["user_id"], $_POST["subject"]);

            $message = "Report sent. Thanks for your cooperation.";

        }
        else {
            $message = "Choose a subject for report";
        }
    }

    


}

require("views/reportpost.php");

?>