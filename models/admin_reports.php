<?php

require_once("base.php");

class Admin_Reports extends Base{

    public function getReportById($id) {

        $query = $this->db->prepare("
            SELECT
                ar.admin_report_id,
                ar.admin_id,
                ar.admin_message,
                ar.created_at,
                u.username
            FROM
                admin_reports AS ar
            INNER JOIN
                users AS u ON ar.admin_id = u.user_id
            WHERE
                ar.admin_report_id = ?
        ");

        $query->execute([$id]);

        return $query->fetch();
    }

    public function getActive() {

        $query = $this->db->prepare("
            SELECT
                ar.admin_report_id,
                ar.admin_id,
                ar.admin_message,
                ar.created_at,
                ar.archived,
                u.username
            FROM
                admin_reports AS ar
            INNER JOIN
                users AS u ON ar.admin_id = u.user_id
            WHERE
                archived IS FALSE
            ORDER BY
                admin_report_id DESC
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function createAdminReport($user_id, $data) {

        $query = $this->db->prepare("
            INSERT INTO admin_reports
            (admin_id, admin_message)
            VALUES(?, ?)
        ");

        return $query->execute([
            $user_id,
            $data
        ]);
    }

    public function updateAdminReport($super_admin_id, $admin_report_id) {

        $query = $this->db->prepare("
            UPDATE
                admin_reports
            SET
                archived = 1,
                archived_by = ?,
                archived_at = CURRENT_TIMESTAMP
            WHERE
                admin_report_id = ?
        ");

        return $query->execute([
            $super_admin_id,
            $admin_report_id
        ]);
    }
}

?>