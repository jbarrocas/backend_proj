<?php

require_once("base.php");

class Posts extends Base {
    public function getRecentPosts() {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                c.name AS country,
                (SELECT COUNT(*)
                FROM likes
                WHERE likes.post_id = p.post_id) AS like_count,
                likes.user_id AS liked
            FROM
                posts AS p
            INNER JOIN
                users AS u USING(user_id)
            INNER JOIN
                countries AS c USING(country_id)
            LEFT JOIN
                likes ON likes.post_id = p.post_id AND likes.user_id = ?
            ORDER BY
                p.post_id DESC
            LIMIT 20
        ");

        $query->execute(
            [$_SESSION["user_id"]]
        );

        return $query->fetchAll();
    }
}

?>