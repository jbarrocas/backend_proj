<?php

require_once("base.php");

class Post_Reports extends Base{

    public function getReports() {

        $query = $this->db->prepare("
            SELECT
                pr.post_report_id,
                pr.post_id,
                pr.user_id,
                pr.subject_id,
                pr.reported_at,
                pr.procedure_id,
                u.username,
                rs.name
            FROM
                post_reports AS pr
            INNER JOIN users AS u USING(user_id)
            INNER JOIN report_subjects AS rs ON pr.subject_id = rs.report_subject_id
            WHERE
                pr.procedure_id IS NULL
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
                pr.subject_id,
                pr.user_id AS reported_by,        
                pr.reported_at,
                p.photo,
                p.title,
                p.content,
                p.user_id AS post_author,
                rs.name
            FROM
                post_reports AS pr
            INNER JOIN posts AS p USING(post_id)
            INNER JOIN report_subjects AS rs ON pr.subject_id = rs.report_subject_id
            LEFT JOIN users ON users.user_id = pr.user_id AND users.user_id = p.user_id
            WHERE
                p.post_id = ?
        ");

        $query->execute([$id]);

        return $query->fetch();
    }

    public function updateReport($data, $admin_id, $post_id) {

        $query = $this->db->prepare("
            UPDATE
                post_reports
            SET
                procedure_id = ?,
                reviewed_at = CURRENT_TIMESTAMP,
                reviewed_by = ?
            WHERE
                post_id = ?
            ");

        $query->execute([
            $data,
            $admin_id,
            $post_id
        ]);

    }

    public function createReport($post_id, $user_id, $data) {

        $query = $this->db->prepare("
            INSERT INTO post_reports
            (post_id, user_id, subject_id)
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