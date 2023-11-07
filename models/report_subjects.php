<?php

require_once("base.php");

class Report_subjects extends Base{

    public function get(){

        $query = $this->db->prepare("
            SELECT 
                report_subject_id, name
            FROM
                report_subjects
        ");

        $query->execute();

        return $query->fetchAll();
    }
}

?>