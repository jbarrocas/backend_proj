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

    public function getById($user_id) {

        $query = $this->db->prepare("
            SELECT
                u.user_id,
                u.username,
                u.first_name,
                u.last_name,
                u.email,
                u.photo,
                u.password,
                c.name AS country
            FROM
                users AS u
            INNER JOIN
                countries AS c USING(country_id)
            WHERE
                user_id = ?
        ");

        $query->execute([ $user_id ]);

        return $query->fetch();
    }

    public function createUser($data) {

        $query = $this->db->prepare("
            INSERT INTO users
            (first_name,
            last_name,
            username,
            email,
            password,
            country_id)
            VALUES(?, ?, ?, ?, ?, ?)
        ");

        $query->execute([
            $data["first_name"],
            $data["last_name"],
            $data["username"],
            $data["email"],
            password_hash($data["password"], PASSWORD_DEFAULT),
            $data["country_id"]
        ]);

        $data["user_id"] = $this->db->lastInsertId();

        return $data;
    }

    public function updatePhoto($data, $user_id) {

        $query = $this->db->prepare("
            UPDATE
                users
            SET
                photo = ?
            WHERE
                user_id = ?
        ");

        $query->execute([
            $_FILES["photo"],
            $user_id
        ]);

        return $data;
    }

    public function updatedetails($data, $user_id) {

        $query = $this->db->prepare("
            UPDATE
                users
            SET
                first_name = ?,
                last_name = ?,
                email = ?,
                password = ?,
                country_id = ?
            WHERE
                user_id = ?
        ");

        $query->execute([
            $data["first_name"],
            $data["last_name"],
            $data["email"],
            password_hash($data["password"], PASSWORD_DEFAULT),
            $data["country_id"],            
            $user_id
        ]);

        return $data;
    }
}

?>