<?php

require_once("base.php");

class Comments_Reports extends Base{

    public function createReport($comment_id, $user_id, $data) {

        $query = $this->db->prepare("
            INSERT INTO comments_reports
            (comment_id, user_id, subject)
            VALUES(?, ?, ?)
        ");

        $query->execute([
            $comment_id,
            $user_id,
            $data
        ]);
    }
}

?>