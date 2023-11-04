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
                co.name AS country
            FROM
                comments AS c
            INNER JOIN
                users AS u USING(user_id)
            INNER JOIN
                posts as p USING(post_id)
            INNER JOIN
                countries as co USING(country_id)
            WHERE
                post_id = ?
            ");

        $query->execute([$id]);

        return $query->fetchAll();
    }

    public function createComment($data, $id, $user_id) {

        $query = $this->db->prepare("
            INSERT INTO comments
            (content,
            post_id,
            user_id)
            VALUES(?, ?, ?)
        ");

        $query->execute([
            $data,
            $id,
            $user_id
        ]);

        return $this->db->lastInsertId();
    }
}

?>