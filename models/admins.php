<?php

require_once("base.php");

class Admins extends Base
{

    public function getByEmail($email) {

        $query = $this->db->prepare("
            SELECT
                admin_id,
                first_name,
                last_name,
                password
            FROM
                admins
            WHERE
                email = ?
        ");

        $query->execute([ $email ]);

        return $query->fetch();
    }

    public function getById($admin_id) {

        $query = $this->db->prepare("
            SELECT
                a.admin_id,
                a.username,
                a.first_name,
                a.last_name,
                a.email,
                a.photo,
                a.super_admin,
                c.name AS country,
                c.country_id
            FROM
                admins AS a
            INNER JOIN
                countries AS c USING(country_id)
            WHERE
                a.admin_id = ?
        ");

        $query->execute([ $admin_id ]);

        return $query->fetch();
    }
}

?>