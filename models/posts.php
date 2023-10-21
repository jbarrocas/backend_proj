<?php

require_once("base.php");

class Posts extends Base {
    public function getPosts() {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                c.name AS country
            FROM
                posts AS p
            INNER JOIN
                users AS u USING(user_id)
            INNER JOIN
                countries AS c USING(country_id)
            ORDER BY
                p.post_id DESC
            LIMIT 20
        ");

        $query->execute();

        return $query->fetchAll();
    }
}

?>