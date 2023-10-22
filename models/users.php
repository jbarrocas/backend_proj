<?php

require_once("base.php");

class Users extends Base
{
    public function getByEmail($email) {

        $query = $this->db->prepare("
            SELECT
                user_id, password
            FROM
                users
            WHERE
                email = ?
        ");

        $query->execute([ $email ]);

        return $query->fetch();
    }
}

?>