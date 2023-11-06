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
                p.post_id = ? AND c.parent_id IS NULL
            ");

        $query->execute([$id]);

        return $query->fetchAll();
    }

    public function getRepliesByCommentId($comment_id) {

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
                c.parent_id = ?
            ");

        $query->execute([$comment_id]);

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
}

?>