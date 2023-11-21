<?php

require_once("base.php");

class Password_Resets extends Base{

    public function getPasswordReset($email) {

        $query = $this->db->prepare("
            SELECT
                user_email,
                token,
                created_at
            FROM
                password_resets
            WHERE
                user_email = ?

        ");

        $query->execute([$email]);

        return $query->fetch();
    }

    public function createPasswordReset($user_email, $token) {

        $query = $this->db->prepare("
            INSERT INTO password_resets
            (user_email,
            token)
            VALUES(?, ?)
        ");

        $query->execute([
            $user_email,
            password_hash($token, PASSWORD_DEFAULT)
        ]);
    }

    public function deletePasswordReset($email) {

        $query = $this->db->prepare("
        DELETE FROM password_resets
        WHERE user_email = ?
    ");

    return $query->execute([$email]);
    }
}

?>