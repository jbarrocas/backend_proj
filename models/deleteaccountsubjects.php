<?php

require_once("base.php");

class Delete_subjects extends Base{

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
}

?>