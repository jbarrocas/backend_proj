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
        !isset($_SESSION["is_admin"]) &&
        !isset($_SESSION["is_super_admin"])
    ) {

        http_response_code(403);
        die("Forbidden");
    }
    else {

        require("models/post_reports.php");

        $model = new Post_Reports();
        $postReport = $model->getReportById($id);

        if( empty($postReport) ) {
            http_response_code(404);
            die("Not found");
        }

        require("models/users.php");

        $modelUsers = new Users();
        $user = $modelUsers->getById($postReport["post_author"]);

        if(isset($_POST["dismiss"])) {

            require("models/posts.php");

            $action = "dismiss";

            $model->updateReport($action, $_SESSION["user_id"], $postReport["post_id"]);

            $reportedBy = $modelUsers->getById($postReport["reported_by"]);

            $subject = "Post report follow-up.";

            $message = "<p>We have received your complaint about a post on our website.
            After checking it, we came to the conclusion that there was no reason for it.
            If you would like to report a comment instead of the post, please use the button next to the comment to do so.
            If you still find the post offensive and don't agree with our decision, you can always contact us.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            require("functions/sendemail.php");
            sendEmail($reportedBy["email"], $reportedBy["first_name"], $reportedBy["last_name"], $subject, $message);

            header("Location: /admin_postreports/");
        }
    }
}

require("views/admin_postreportdetail.php");

?>