<?php

require("models/deleteaccountsubjects.php");

$modelDeleteSubjects = new Delete_Subjects();
$subjects = $modelDeleteSubjects->get();

$deleteSubjects = [];
foreach($subjects as $subject){
    $deleteSubjects[] = $subject["delete_account_subject_id"];
}

if(!isset($_SESSION["user_id"])) {

    header("Location:/login/");
}
else {

    if(isset($_POST["delete"])) {

        print_r($_POST);

        foreach($_POST as $key => $value){
            $_POST[ $key ] = htmlspecialchars(strip_tags(trim($value)));
        }

        if(
            empty($_POST["subject_id"]) ||
            !in_array($_POST["subject_id"], $deleteSubjects)
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
                    $_POST["subject_id"],
                    $_POST["delete_motive"],
                    $user["email"]
                );
            }
            else {

                $modelReport->createReportWithoutText(
                    $_POST["subject_id"],
                    $user["email"]
                );
            }

            require("models/posts.php");
            $modelPosts = new Posts();
            $postsCount = $modelPosts->getPostsCountByUser($_SESSION["user_id"]);
            $limit = $postsCount["posts_count"];
            $offset = 0;
            $posts = $modelPosts->getPostsByUser($_SESSION["user_id"], $_SESSION["user_id"], $limit, $offset);

            foreach($posts as $post) {

                $postPhoto = "images/posts/" . $post["photo"];
                unlink($postPhoto);
                $modelPosts->delete($post["post_id"]);                
            }

            $modelUser->deleteUser($_SESSION["user_id"]);

            $userPhoto = "images/users/" . $user["photo"];
            unlink($userPhoto);

            http_response_code(202);

            session_unset();

            session_destroy();

            header("Location: /login/");
        }
    }
}

require("views/deleteaccount.php");

?>