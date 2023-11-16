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

    public function getReportById($id) {

        $query = $this->db->prepare("
            SELECT
                pr.post_report_id,
                pr.post_id,
                pr.subject,
                pr.user_id AS reported_by,        
                pr.reported_at,
                p.photo,
                p.title,
                p.content,
                p.user_id AS post_author
            FROM
                post_reports AS pr
            INNER JOIN posts AS p USING(post_id)
            LEFT JOIN users ON users.user_id = pr.user_id AND users.user_id = p.user_id
            WHERE
                p.post_id = ?
        ");

        $query->execute([$id]);

        return $query->fetch();
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