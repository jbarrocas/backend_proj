<?php

require_once("base.php");

class Users extends Base
{
    public function getByUsername($username) {

        $query = $this->db->prepare("
            SELECT
                username
            FROM
                users
            WHERE
                username = ?
        ");

        $query->execute([ $username ]);

        return $query->fetch();
    }

    public function getByEmail($email) {

        $query = $this->db->prepare("
            SELECT
                user_id,
                first_name,
                last_name,
                password,
                is_admin,
                is_super_admin
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
                u.created_at,
                u.is_admin,
                u.is_super_admin,
                u.admin_status_updated_at,
                u.email,
                u.photo,
                u.password,
                u.restricted_until,
                c.name AS country,
                c.country_id
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

    public function searchUser($search) {

        $query = $this->db->prepare("
            SELECT
                user_id,
                username,
                first_name,
                last_name,
                email,
                photo,
                is_admin,
                is_super_admin,
                c.name AS country,
                c.country_id
            FROM
                users
            INNER JOIN
                countries AS c USING(country_id)
            WHERE
                username LIKE ?
                OR first_name LIKE ?
                OR last_name LIKE ?
                OR email LIKE ?
            LIMIT 100 OFFSET 0
        ");

        $query->execute(
            ["%".$search."%",
            "%".$search."%",
            "%".$search."%",
            "%".$search."%"]
        );

        return $query->fetchAll();;
    }

    public function getAdmins($is_admin) {

        $query = $this->db->prepare("
            SELECT
                user_id,
                username,
                first_name,
                last_name,
                email,
                photo,
                is_admin,
                is_super_admin,
                c.name AS country,
                c.country_id
            FROM
                users
            INNER JOIN
                countries AS c USING(country_id)
            WHERE
                is_admin = ?
            ORDER BY
                is_super_admin, is_admin, admin_status_updated_at DESC
        ");

        $query->execute([
            $is_admin
        ]);

        return $query->fetchAll();
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
            $data["photo"],
            $user_id
        ]);

        return $data;
    }

    public function updatePhotoPath($path, $user_id) {

        $query = $this->db->prepare("
            UPDATE
                users
            SET
                photo = ?
            WHERE
                user_id = ?
        ");

        return $query->execute([
            $path, $user_id
        ]);
    }

    public function updateDetails($data, $user_id) {

        $query = $this->db->prepare("
            UPDATE
                users
            SET
                first_name = ?,
                last_name = ?,
                email = ?,
                country_id = ?
            WHERE
                user_id = ?
        ");

        $query->execute([
            $data["first_name"],
            $data["last_name"],
            $data["email"],
            $data["country_id"],            
            $user_id
        ]);

        return $data;
    }

    public function updatePassword($data, $user_id) {

        $query = $this->db->prepare("
            UPDATE
                users
            SET
                password = ?
            WHERE
                user_id = ?
        ");

        $query->execute([
            password_hash($data["new_password"], PASSWORD_DEFAULT),
            $user_id
        ]);

        return $data;
    }

    public function updateAdminStatus($data, $user_id) {

        $query = $this->db->prepare("
            UPDATE
                users
            SET
                is_admin = ?,
                is_super_admin = ?,
                admin_status_updated_at = CURRENT_TIMESTAMP
            WHERE
                user_id = ?
        ");

        $query->execute([
            $data["is_admin"],
            $data["is_super_admin"],
            $user_id
        ]);

        return $data;
    }

    public function updateRestrictStatus($user_id) {

        $query = $this->db->prepare("
            UPDATE
                users
            SET
                restricted_until = DATE_ADD(CURRENT_TIMESTAMP, INTERVAL 2 DAY)
            WHERE
                user_id = ?
        ");

        $query->execute([
            $user_id
        ]);
    }

    public function deleteUser($user_id) {

        $query = $this->db->prepare("
            DELETE FROM users
            WHERE user_id = ?
        ");

        $query->execute(["$user_id"]);
    }
}

?>