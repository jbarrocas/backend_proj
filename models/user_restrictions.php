<?php

require_once("base.php");

class User_Restrictions extends Base{

    public function createUserRestriction($user_id) {

        $query = $this->db->prepare("
            INSERT INTO user_restrictions
            (restricted_id)
            VALUES(?)
        ");

        $query->execute([$user_id]);
    }
}

?>