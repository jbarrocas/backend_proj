<?php

require_once("base.php");

class Procedure_Subjects extends Base{

    public function get(){

        $query = $this->db->prepare("
            SELECT 
                procedure_id, name
            FROM
                procedure_subjects
        ");

        $query->execute();

        return $query->fetchAll();
    }
}

?>