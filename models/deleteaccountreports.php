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
        LIMIT 100
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getReportsOfLastWeek() {

        $query = $this->db->prepare("
        SELECT
            delete_account_report_id,
            subject,
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
            subject,
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
                subject, COUNT(*) AS count 
            FROM
                delete_account_reports
            WHERE
                deleted_at > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -7 DAY)
            GROUP BY
                subject
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getCountBySubjectLastMonth() {

        $query = $this->db->prepare("
            SELECT
                subject, COUNT(*) AS count 
            FROM
                delete_account_reports
            WHERE
                deleted_at > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -30 DAY)
            GROUP BY
                subject
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function createReport($subject, $email, $delete_motive) {

        $query = $this->db->prepare("
            INSERT INTO delete_account_reports
            (subject, user_email, user_text)
            VALUES(?, ?, ?)
        ");

        $query->execute([
            $subject,
            $email,
            $delete_motive
        ]);
    }
}

?>