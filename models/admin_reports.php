<?php

require_once("base.php");

class Admin_Reports extends Base{

    public function getActive() {

        $query = $this->db->prepare("
            SELECT
                admin_id,
                admin_message,
                created_at,
                archived
            FROM
                admin_reports
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

    public function updateAdminReport($archived, $super_admin_id, $admin_id) {

        $query = $this->db->prepare("
            UPDATE
                admin_reports
            SET
                archived = ?,
                archived_by = ?,
                archived_at = CURRENT_TIMESTAMP
            WHERE
                user_id = ?
        ");

        return $query->execute([
            $archived,
            $super_admin_id,
            $admin_id
        ]);
    }
}

?>