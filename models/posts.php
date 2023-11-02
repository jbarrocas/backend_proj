<?php

require_once("base.php");

class Posts extends Base {

    public function getPostsCountByUser($user_id) {

        $query = $this->db->prepare("
            SELECT
                COUNT(*) AS posts_count
            FROM
                posts
            WHERE
                user_id = ?
        ");

        $query->execute([$user_id]);

        return $query->fetch();
    }

    public function getRecentPosts() {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                u.user_id,
                c.name AS country,
                likes.user_id AS liked,
                (SELECT COUNT(*)
                FROM likes
                WHERE likes.post_id = p.post_id) AS like_count,
                (SELECT COUNT(*)
                FROM comments
                WHERE comments.post_id = p.post_id) AS comments_count 
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

    public function getPostById($id) {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                u.user_id,
                c.name AS country
            FROM
                posts AS p
            INNER JOIN
                users AS u USING(user_id)
            INNER JOIN
                countries AS c USING(country_id)
            WHERE
                p.post_id = ?
            LIMIT 20
        ");

        $query->execute(
            [$id]
        );

        return $query->fetch();
    }

    public function getPostsByUser($user_id, $id) {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                u.user_id,
                c.name AS country,
                likes.user_id AS liked,
                (SELECT COUNT(*)
                FROM likes
                WHERE likes.post_id = p.post_id) AS like_count,
                (SELECT COUNT(*)
                FROM comments
                WHERE comments.post_id = p.post_id) AS comments_count           
            FROM
                posts AS p
            INNER JOIN
                users AS u USING(user_id)
            INNER JOIN
                countries AS c USING(country_id)
            LEFT JOIN
                likes ON likes.post_id = p.post_id AND likes.user_id = ?
            WHERE
                u.user_id = ?
            ORDER BY
                p.post_id DESC
            LIMIT 20
        ");

        $query->execute(
            [
                $user_id,
                $id
            ]
        );

        return $query->fetchAll();
    }

    public function createPost($data) {

        $query = $this->db->prepare("
            INSERT INTO posts
            (title,
            content,
            photo,
            user_id)
            VALUES(?, ?, ?, ?)
        ");

        $query->execute([
            $data["title"],
            $data["content"],
            $_FILES["photo"],
            $_SESSION["user_id"]
        ]);

        $_SESSION["post_id"] = $this->db->lastInsertId();        

        return $data;
    }
}

?>