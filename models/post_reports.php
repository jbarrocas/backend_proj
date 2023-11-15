<?php

require_once("base.php");

class Post_Reports extends Base{

    public function getReports() {

        $query = $this->db->prepare("
            SELECT
                pr.post_report_id,
                pr.post_id,
                pr.user_id,
                pr.subject,
                pr.reported_at,
                u.username
            FROM
                post_reports AS pr
            INNER JOIN users AS u USING(user_id)
            LIMIT 20
        ");

        $query->execute();

        return $query->fetchAll();
    }

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