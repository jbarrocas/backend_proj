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

        require("models/posts.php");
        $modelPosts = new Posts();

        require("models/procedure_subjects.php");
        $modelActions = new Procedure_Subjects();

        if(isset($_POST["dismiss"])) {

            $modelAction = $modelActions->get();

            $procedure = $modelAction[0];

            $modelPostReports->updateReport($procedure["procedure_id"], $_SESSION["user_id"], $postReport["post_id"]);

            $reportedBy = $modelUsers->getById($postReport["reported_by"]);

            $complainer_f_name = $reportedBy["first_name"];

            $subject = "Post report follow-up.";

            $message = "<p>Dear $complainer_f_name.</p>
            <p>We have received your complaint about a post on our website.</p>
            <p>After checking it, we came to the conclusion that there was no reason for it.</p>
            <p>If you would like to report a comment instead of the post, please use the button next to the comment to do so.</p>
            <p>If you still find the post offensive and don't agree with our decision, you can always contact us.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($reportedBy["email"], $reportedBy["first_name"], $reportedBy["last_name"], $subject, $message);

            http_response_code(202);

            header("Location: /admin_postreports/");
        }

        require("models/user_restrictions.php");

        if(isset($_POST["restrict_privileges"])) {

            $modelAction = $modelActions->get();

            $procedure = $modelAction[1];

            $modelPostReports->updateReport($procedure["procedure_id"], $_SESSION["user_id"], $postReport["post_id"]);

            $modelRestriction = new User_Restrictions();
            $modelRestriction->createUserRestriction($postReport["post_author"]);

            $modelUsers->updateRestrictStatus($postReport["post_author"]);

            $post = $modelPosts->getPostById($postReport["post_id"]);
            $postPhoto = "images/posts/" . $post["photo"];
            unlink($postPhoto);

            $modelPosts->delete($postReport["post_id"]);

            $reportedBy = $modelUsers->getById($postReport["reported_by"]);

            $complainer_f_name = $reportedBy["first_name"];

            $subject = "Post report follow-up.";

            $message = "<p>Dear $complainer_f_name.</p>
            <p>We have received your complaint about a post on our website.</p>
            <p>After checking it, we have come to the conclusion that there was a reason for 
            it and have imposed a temporary sanction on the user.</p>
            <p>Thank you for helping us to keep Postapol a safe place.</p>          
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($reportedBy["email"], $reportedBy["first_name"], $reportedBy["last_name"], $subject, $message);

            $createdBy = $modelUsers->getById($postReport["post_author"]);

            $prevaricator_f_name = $createdBy["first_name"];

            $subject = "Post Complaint.";

            $message = "<p>Dear $prevaricator_f_name.</p>
            <p>We have received a complaint about a post you made on our site.</p>
            <p>After checking it, we have come to the conclusion that the post does not follow 
            our site's operating rules, which were accepted by you when you registered.</p>
            <p>We understand that we all have bad days and not-so-good days.</p>
            <p>That's why we find ourselves having to sanction you in some way. In this case, 
            you will be unable to post or comment for 2 days.</p>
            We hope you understand our position.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($createdBy["email"], $createdBy["first_name"], $createdBy["last_name"], $subject, $message);

            http_response_code(202);

            header("Location: /admin_postreports/");
        }

        require("models/user_bans.php");

        if(isset($_POST["ban_user"])) {

            $modelAction = $modelActions->get();

            $procedure = $modelAction[2];

            $modelPostReports->updateReport($procedure["procedure_id"], $_SESSION["user_id"], $postReport["post_id"]);

            $modelBan = new User_Bans();
            $modelBan->createUserBan($user["email"], $_SESSION["user_id"]);

            $reportedBy = $modelUsers->getById($postReport["reported_by"]);

            $complainer_f_name = $reportedBy["first_name"];

            $subject = "Post report follow-up.";

            $message = "<p>Dear $complainer_f_name.</p>
            <p>We have received your complaint about a post on our website.</p>
            <p>After checking it, we have come to the conclusion that there was a reason for 
            it and we have banned the user from our site.</p>
            <p>Thank you for helping us to keep Postapol a safe place.</p>            
            <p>Thank you for choosing Postapol.</p>            
            <p>The Postapol team</p>";

            sendEmail($reportedBy["email"], $reportedBy["first_name"], $reportedBy["last_name"], $subject, $message);

            $createdBy = $modelUsers->getById($postReport["post_author"]);

            $prevaricator_f_name = $createdBy["first_name"];

            $subject = "Post Complaint.";

            $message = "<p>Dear $prevaricator_f_name.</p>
            <p>We have received a complaint about a post you made on our site.</p>
            <p>After checking it, we have come to the conclusion that the post does not follow 
            our site's operating rules, which were accepted by you when you registered.</p>
            <p>We do not support this kind of behavior, nor do we accept it on our site.</p>
            <p>For this reason, we have decided to ban your account, making it impossible for you to access Postapol.</p>
            <p>We hope you understand our position.</p>            
            <p>The Postapol team</p>";

            sendEmail($createdBy["email"], $createdBy["first_name"], $createdBy["last_name"], $subject, $message);

            $posts = $modelPosts->getPostsByUser($postReport["post_author"], $postReport["post_author"]);

            foreach($posts as $post) {

                $postPhoto = "images/posts/" . $post["photo"];
                unlink($postPhoto);
                $modelPosts->delete($post["post_id"]);                
            }

            $userPhoto = "images/users/" . $createdBy["photo"];
            unlink($userPhoto);

            $modelUsers->deleteUser($postReport["post_author"]);

            http_response_code(202);

            header("Location: /admin_postreports/");
        }
    }
}

require("views/admin_postreportdetail.php");

?>