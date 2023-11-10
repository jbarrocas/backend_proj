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
            !empty($_POST["subject"]) &&
            in_array($_POST["subject"], $deleteSubjects)
        ) {

            require("models/users.php");
            $modelUser = new Users();
            $user = $modelUser->getById($_SESSION["user_id"]);

            require("models/deleteaccountreports.php");
            $modelReport = new Delete_Reports();
            $modelReport->createReport(
                $_POST["subject"],
                $user["email"],
                $_POST["delete_motive"]
            );

            $modelUser->deleteUser($_SESSION["user_id"]);

            session_unset();

            session_destroy();

            header("Location: /login/");

        }
        else {
            $message = "Choose a subject for report";
        }
    }
}

require("views/deleteaccount.php");

?>