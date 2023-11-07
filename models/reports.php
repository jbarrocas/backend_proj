<?php

require_once("base.php");

class Reports extends Base{

    public function createReport($post_id, $user_id, $data) {

        $query = $this->db->prepare("
            INSERT INTO post_reports
            (post_id, user_id, subject)
            VALUES(?, ?, ?)
        ");

        $query->execute([
            $post_id,
            $user_id,
            $data
        ]);
    }
}

?>