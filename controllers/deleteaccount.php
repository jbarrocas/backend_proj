<?php

require("models/deleteaccountsubjects.php");

$modelDeleteSubjects = new Delete_Subjects();
$subjects = $modelDeleteSubjects->get();

$deleteSubjects = [];
foreach($subjects as $subject){
    $deleteSubjects[] = $subject["name"];
}

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");
}
else {

    if(isset($_POST["send"])) {

        foreach($_POST as $key => $value){
            $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }

        if(
            empty($_POST["subject"]) ||
            !in_array($_POST["subject"], $deleteSubjects)
        ) {
            $message = "Choose a subject for report";
        }
        else {

            require("models/users.php");
            $modelUser = new Users();
            $user = $modelUser->getById($_SESSION["user_id"]);

            require("models/deleteaccountreports.php");
            $modelReport = new Delete_Reports();

            if(!empty($_POST["delete_motive"])) {

                $modelReport->createReport(
                    $_POST["subject"],
                    $_POST["delete_motive"],
                    $user["email"]
                );
            }
            else {

                $modelReport->createReportWithoutText(
                    $_POST["subject"],
                    $user["email"]
                );
            }

            $modelUser->deleteUser($_SESSION["user_id"]);

            $image = "images/users/" . $user["photo"];
            unlink($image);

            http_response_code(202);

            session_unset();

            session_destroy();

            header("Location: /login/");
        }
    }
}

require("views/deleteaccount.php");

?>