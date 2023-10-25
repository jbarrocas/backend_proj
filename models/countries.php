<?php

require_once("base.php");

class Countries extends Base{

    public function get(){

        $query = $this->db->prepare("
            SELECT 
                country_id, name
            FROM
                countries
        ");

        $query->execute();

        return $query->fetchAll();
    }
}

?>