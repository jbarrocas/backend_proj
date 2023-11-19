<?php

require_once("base.php");

class Comments_Reports extends Base{

    public function getReports() {

        $query = $this->db->prepare("
            SELECT
                cr.comment_report_id,
                cr.comment_id,
                cr.user_id,
                cr.subject_id,
                cr.reported_at,
                cr.procedure_id,
                u.username,
                rs.name
            FROM
                comments_reports AS cr
            INNER JOIN users AS u USING(user_id)
            INNER JOIN report_subjects AS rs ON cr.subject_id = rs.report_subject_id
            WHERE
                cr.procedure_id IS NULL
            LIMIT 20
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getReportById($id) {

        $query = $this->db->prepare("
            SELECT
                cr.comment_report_id,
                cr.comment_id,
                cr.subject_id,
                cr.user_id AS reported_by,        
                cr.reported_at,
                c.content,
                c.user_id AS comment_author,
                rs.name
            FROM
                comments_reports AS cr
            INNER JOIN comments AS c USING(comment_id)
            INNER JOIN report_subjects AS rs ON cr.subject_id = rs.report_subject_id
            LEFT JOIN users ON users.user_id = cr.user_id AND users.user_id = c.user_id
            WHERE
                c.comment_id = ?
        ");

        $query->execute([$id]);

        return $query->fetch();
    }

    public function updateReport($data, $admin_id, $comment_id) {

        $query = $this->db->prepare("
            UPDATE
                comments_reports
            SET
                procedure_id = ?,
                reviewed_at = CURRENT_TIMESTAMP,
                reviewed_by = ?
            WHERE
                comment_id = ?
            ");

        $query->execute([
            $data,
            $admin_id,
            $comment_id
        ]);

    }

    public function createReport($comment_id, $user_id, $data) {

        $query = $this->db->prepare("
            INSERT INTO comments_reports
            (comment_id, user_id, subject_id)
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