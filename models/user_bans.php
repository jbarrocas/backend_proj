<?php

require_once("base.php");

class User_Bans extends Base{

    public function getBanByEmail($email) {

        $query = $this->db->prepare("
            SELECT
                email
            FROM
                user_bans
            WHERE
                email = ?
        ");

        $query->execute([$email]);

        return $query->fetch();
    }

    public function createUserBan($email, $banned_by) {

        $query = $this->db->prepare("
            INSERT INTO user_bans
            (email, banned_by)
            VALUES(?, ?)
        ");

        $query->execute([
            $email,
            $banned_by
        ]);
    }
}

?>