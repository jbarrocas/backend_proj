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

        $modelPostReports = new Post_Reports();
        $postReport = $modelPostReports->getReportById($id);

        if( empty($postReport) ) {
            http_response_code(404);
            die("Not found");
        }

        require("models/users.php");

        require("functions/sendemail.php");

        $modelUsers = new Users();
        $user = $modelUsers->getById($postReport["post_author"]);

        if(isset($_POST["dismiss"])) {

            $action = "dismiss";

            $modelPostReports->updateReport($action, $_SESSION["user_id"], $postReport["post_id"]);

            $reportedBy = $modelUsers->getById($postReport["reported_by"]);

            $subject = "Post report follow-up.";

            $message = "<p>We have received your complaint about a post on our website.
            After checking it, we came to the conclusion that there was no reason for it.
            If you would like to report a comment instead of the post, please use the button next to the comment to do so.
            If you still find the post offensive and don't agree with our decision, you can always contact us.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($reportedBy["email"], $reportedBy["first_name"], $reportedBy["last_name"], $subject, $message);

            header("Location: /admin_postreports/");
        }

        require("models/user_restrictions.php");
        require("models/posts.php");

        if(isset($_POST["restrict_privileges"])) {

            $action = "restrict";
            $modelPostReports->updateReport($action, $_SESSION["user_id"], $postReport["post_id"]);

            $modelRestriction = new User_Restrictions();
            $modelRestriction->createPostUserRestriction($postReport["post_author"], $postReport["post_id"]);

            $modelUsers->updateRestrictStatus($postReport["post_author"]);

            $modelPosts = new Posts();
            $modelPosts->delete($postReport["post_id"]);

            $reportedBy = $modelUsers->getById($postReport["reported_by"]);

            $subject = "Post report follow-up.";

            $message = "<p>We have received your complaint about a post on our website.
            After checking it, we have come to the conclusion that there was a reason for 
            it and have imposed a temporary sanction on the user.
            Thank you for helping us to keep Postapol a safe place.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($reportedBy["email"], $reportedBy["first_name"], $reportedBy["last_name"], $subject, $message);

            $createdBy = $modelUsers->getById($postReport["post_author"]);

            $subject = "Post report.";

            $message = "<p>We have received a complaint about a post you made on our site.
            After checking it, we have come to the conclusion that the post does not follow 
            our site's operating rules, which were accepted by you when you registered.
            We understand that we all have bad days and not-so-good days.
            That's why we find ourselves having to sanction you in some way. In this case, 
            you will be unable to post or comment for 3 days.
            We hope you understand our position.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($createdBy["email"], $createdBy["first_name"], $createdBy["last_name"], $subject, $message);

            header("Location: /admin_postreports/");
        }
    }
}

require("views/admin_postreportdetail.php");

?>