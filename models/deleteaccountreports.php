<?php

require_once("base.php");

class Delete_Reports extends Base{

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