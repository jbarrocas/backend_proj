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

        require("models/comments_reports.php");

        $modelCommentReports = new Comments_Reports();
        $commentReport = $modelCommentReports->getReportById($id);

        if( empty($commentReport) ) {
            http_response_code(404);
            die("Not found");
        }

        require("models/users.php");

        require("functions/sendemail.php");

        $modelUsers = new Users();
        $user = $modelUsers->getById($commentReport["comment_author"]);

        require("models/comments.php");
        $modelComments = new Comments();

        require("models/procedure_subjects.php");
        $modelActions = new Procedure_Subjects();

        if(isset($_POST["dismiss"])) {

            $modelAction = $modelActions->get();

            $procedure = $modelAction[0];

            $modelCommentReports->updateReport($procedure["procedure_id"], $_SESSION["user_id"], $commentReport["comment_id"]);

            $reportedBy = $modelUsers->getById($commentReport["reported_by"]);

            $complainer_f_name = $reportedBy["first_name"];

            $subject = "Comment report follow-up.";

            $message = "<p>Dear $complainer_f_name.</p>
            <p>We have received your complaint about a comment on our website.</p>
            <p>After checking it, we came to the conclusion that there was no reason for it.</p>
            <p>If you would like to report a post instead of the comment, please use the button next to the post to do so.</p>
            <p>If you still find the comment offensive and don't agree with our decision, you can always contact us.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($reportedBy["email"], $reportedBy["first_name"], $reportedBy["last_name"], $subject, $message);

            http_response_code(202);

            header("Location: /admin_commentreports/");
        }

        require("models/user_restrictions.php");

        if(isset($_POST["restrict_privileges"])) {

            $modelAction = $modelActions->get();

            $procedure = $modelAction[1];

            $modelCommentReports->updateReport($procedure["procedure_id"], $_SESSION["user_id"], $commentReport["comment_id"]);

            $modelRestriction = new User_Restrictions();
            $modelRestriction->createUserRestriction($commentReport["comment_author"]);

            $modelUsers->updateRestrictStatus($commentReport["comment_author"]);

            $modelComments->delete($commentReport["comment_id"]);

            $reportedBy = $modelUsers->getById($commentReport["reported_by"]);

            $complainer_f_name = $reportedBy["first_name"];

            $subject = "Comment report follow-up.";

            $message = "<p>Dear $complainer_f_name.</p>
            <p>We have received your complaint about a comment on our website.</p>
            <p>After checking it, we have come to the conclusion that there was a reason for 
            it and have imposed a temporary sanction on the user.</p>
            <p>Thank you for helping us to keep Postapol a safe place.</p>          
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($reportedBy["email"], $reportedBy["first_name"], $reportedBy["last_name"], $subject, $message);

            $createdBy = $modelUsers->getById($commentReport["comment_author"]);

            $prevaricator_f_name = $createdBy["first_name"];

            $subject = "Comment Complaint.";

            $message = "<p>Dear $prevaricator_f_name.</p>
            <p>We have received a complaint about a comment you made on our site.</p>
            <p>After checking it, we have come to the conclusion that the comment does not follow 
            our site's operating rules, which were accepted by you when you registered.</p>
            <p>We understand that we all have bad days and not-so-good days.</p>
            <p>That's why we find ourselves having to sanction you in some way. In this case, 
            you will be unable to post or comment for 2 days.</p>
            We hope you understand our position.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($createdBy["email"], $createdBy["first_name"], $createdBy["last_name"], $subject, $message);

            http_response_code(202);

            header("Location: /admin_commentreports/");
        }

        require("models/user_bans.php");

        if(isset($_POST["ban_user"])) {

            $modelAction = $modelActions->get();

            $procedure = $modelAction[2];

            $modelCommentReports->updateReport($procedure["procedure_id"], $_SESSION["user_id"], $commentReport["comment_id"]);

            $modelBan = new User_Bans();
            $modelBan->createUserBan($user["email"], $_SESSION["user_id"]);

            $modelComments->delete($commentReport["comment_id"]);

            $reportedBy = $modelUsers->getById($commentReport["reported_by"]);

            $complainer_f_name = $reportedBy["first_name"];

            $subject = "Comment report follow-up.";

            $message = "<p>Dear $complainer_f_name.</p>
            <p>We have received your complaint about a comment on our website.</p>
            <p>After checking it, we have come to the conclusion that there was a reason for 
            it and we have banned the user from our site.</p>
            <p>Thank you for helping us to keep Postapol a safe place.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($reportedBy["email"], $reportedBy["first_name"], $reportedBy["last_name"], $subject, $message);

            $createdBy = $modelUsers->getById($commentReport["comment_author"]);

            $prevaricator_f_name = $createdBy["first_name"];

            $subject = "Comment Complaint.";

            $message = "<p>Dear $prevaricator_f_name.</p>
            <p>We have received a complaint about a comment you made on our site.</p>
            <p>After checking it, we have come to the conclusion that the comment does not follow 
            our site's operating rules, which were accepted by you when you registered.</p>
            <p>We do not support this kind of behavior, nor do we accept it on our site.</p>
            <p>For this reason, we have decided to ban your account, making it impossible for you to access Postapol.</p>
            <p>We hope you understand our position.</p>            
            <p>The Postapol team</p>";

            sendEmail($createdBy["email"], $createdBy["first_name"], $createdBy["last_name"], $subject, $message);

            $posts = $modelPosts->getPostsByUser($postReport["comment_author"], $postReport["comment_author"]);

            foreach($posts as $post) {

                $postPhoto = "images/posts/" . $post["photo"];
                unlink($postPhoto);
                $modelPosts->delete($post["post_id"]);                
            }

            $userPhoto = "images/users/" . $createdBy["photo"];
            unlink($userPhoto);

            $modelUsers->deleteUser($commentReport["comment_author"]);

            http_response_code(202);

            header("Location: /admin_commentreports/");
        }
    }
}

require("views/admin_commentreportdetail.php");

?>