<?php

require_once("base.php");

class Delete_Subjects extends Base{

    public function get(){

        $query = $this->db->prepare("
            SELECT 
                delete_account_subject_id, name
            FROM
                delete_account_subjects
        ");

        $query->execute();

        return $query->fetchAll();
    }

    public function getById($id) {

        $query = $this->db->prepare("
        SELECT
            delete_account_subject_id,
            name
        FROM
            delete_account_subjects
        ");

        $query->execute();

        return $query->fetchAll();
    }
}

?>