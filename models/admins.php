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
                a.password,
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

    public function getByUsername($username) {

        $query = $this->db->prepare("
            SELECT
                username
            FROM
                admins
            WHERE
                username = ?
        ");

        $query->execute([ $username ]);

        return $query->fetch();
    }

    public function createAdmin($data) {

        $query = $this->db->prepare("
            INSERT INTO admins
            (first_name,
            last_name,
            username,
            email,
            password,
            country_id,
            super_admin)
            VALUES(?, ?, ?, ?, ?, ?, ?)
        ");

        $query->execute([
            $data["first_name"],
            $data["last_name"],
            $data["username"],
            $data["email"],
            password_hash($data["password"], PASSWORD_DEFAULT),
            $data["country_id"],
            $data["super_admin"]
        ]);

        $data["admin_id"] = $this->db->lastInsertId();

        return $data;
    }

    public function updateDetails($data, $admin_id) {

        $query = $this->db->prepare("
            UPDATE
                admins
            SET
                first_name = ?,
                last_name = ?,
                email = ?,
                country_id = ?
            WHERE
                admin_id = ?
        ");

        $query->execute([
            $data["first_name"],
            $data["last_name"],
            $data["email"],
            $data["country_id"],            
            $admin_id
        ]);

        return $data;
    }

    public function updatePassword($data, $admin_id) {

        $query = $this->db->prepare("
            UPDATE
                admins
            SET
                password = ?
            WHERE
                admin_id = ?
        ");

        $query->execute([
            password_hash($data["new_password"], PASSWORD_DEFAULT),
            $admin_id
        ]);

        return $data;
    }
}

?>