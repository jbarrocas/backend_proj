<?php

require_once("base.php");

class Comments extends Base
{
    public function getCommentsByPostId($id) {

        $query = $this->db->prepare("
            SELECT
                c.comment_id,
                c.content,
                c.comment_date,
                c.parent_id,
                p.post_id,
                u.username,
                u.photo,
                co.name AS country,
            CASE WHEN c.parent_id IS NOT NULL
            THEN c.parent_id
            ELSE comment_id END AS order_id
            FROM
                comments AS c
            INNER JOIN
                users AS u USING(user_id)
            INNER JOIN
                posts as p USING(post_id)
            INNER JOIN
                countries as co USING(country_id)
            WHERE
                p.post_id = ?
            ORDER BY
                order_id, c.comment_id
            ");

        $query->execute([$id]);

        return $query->fetchAll();
    }

    public function getCommentById($id) {

        $query = $this->db->prepare("
            SELECT
                c.comment_id,
                c.content,
                c.comment_date,
                c.user_id AS comment_author,
                p.post_id,
                p.user_id,
                u.username
            FROM
                comments AS c
            INNER JOIN
                users AS u USING(user_id)
            INNER JOIN
                posts as p USING(post_id)
            WHERE
                c.comment_id = ?
            ");

        $query->execute([$id]);

        return $query->fetch();
    }

    public function createComment($data, $id, $user_id) {

        $query = $this->db->prepare("
            INSERT INTO comments
            (content,
            post_id,
            user_id)
            VALUES(?, ?, ?)
        ");

        return $query->execute([
            $data,
            $id,
            $user_id
        ]);
    }

    public function createReply($data, $user_id) {

        $query = $this->db->prepare("
            INSERT INTO comments
            (content,
            post_id,
            parent_id,
            user_id)
            VALUES(?, ?, ?, ?)
        ");

        return $query->execute([
            $data["content"],
            $data["post_id"],
            $data["parent_id"],
            $user_id
        ]);
    }

    public function delete($id) {

        $query = $this->db->prepare("
            DELETE FROM comments
            WHERE comment_id = ?
        ");

        $query->execute([$id]);
    }
}

?>