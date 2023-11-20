<?php

require_once("base.php");

class Delete_Reports extends Base{

    public function getReports() {

        $query = $this->db->prepare("
        SELECT
            delete_account_report_id,
            subject,
            user_text,
            deleted_at
        FROM
            delete_account_reports
        ORDER BY
            deleted_at DESC
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getReportsWithText() {

        $query = $this->db->prepare("
        SELECT
            delete_account_report_id,
            subject_id,
            user_text,
            deleted_at,
            das.name
        FROM
            delete_account_reports
        INNER JOIN
            delete_account_subjects AS das ON subject_id = das.delete_account_subject_id
        WHERE
            user_text IS NOT NULL
        ORDER BY
            deleted_at DESC
        LIMIT 100
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getReportById($report_id) {

        $query = $this->db->prepare("
        SELECT
            subject_id,
            user_text,
            deleted_at,
            das.name
        FROM
            delete_account_reports
        INNER JOIN
            delete_account_subjects AS das ON subject_id = das.delete_account_subject_id
        WHERE
            delete_account_report_id = ?
        ");

        $query->execute([$report_id]);

        return $query->fetch();
    }

    public function getReportsOfLastWeek() {

        $query = $this->db->prepare("
        SELECT
            delete_account_report_id,
            subject_id,
            user_text,
            deleted_at
        FROM
            delete_account_reports
        WHERE
            deleted_at > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -7 DAY)
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getReportsOfLastMonth() {

        $query = $this->db->prepare("
        SELECT
            delete_account_report_id,
            subject_id,
            user_text,
            deleted_at
        FROM
            delete_account_reports
        WHERE
            deleted_at > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -30 DAY)
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getCountBySubjectLastWeek() {

        $query = $this->db->prepare("
            SELECT
                das.name,
                subject_id, COUNT(*) AS count
            FROM
                delete_account_reports
            INNER JOIN
                delete_account_subjects AS das ON subject_id = das.delete_account_subject_id
            WHERE
                deleted_at > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -7 DAY)
            GROUP BY
                subject_id
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getCountBySubjectLastMonth() {

        $query = $this->db->prepare("
            SELECT
                das.name,
                subject_id, COUNT(*) AS count 
            FROM
                delete_account_reports
            INNER JOIN
                delete_account_subjects AS das ON subject_id = das.delete_account_subject_id
            WHERE
                deleted_at > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -30 DAY)
            GROUP BY
                subject_id
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function createReport($subject_id, $motive, $email) {

        $query = $this->db->prepare("
            INSERT INTO delete_account_reports
            (subject_id, user_text, user_email)
            VALUES(?, ?, ?)
        ");

        $query->execute([
            $subject_id,
            $motive,
            $email
        ]);
    }

    public function createReportWithoutText($data, $email) {

        $query = $this->db->prepare("
            INSERT INTO delete_account_reports
            (subject_id, user_email)
            VALUES(?, ?)
        ");

        $query->execute([
            $data,
            $email
        ]);
    }
}

?>