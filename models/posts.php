<?php

require_once("base.php");

class Posts extends Base {

    public function getRecentPosts($user_id, $limit, $offset) {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                u.user_id,
                u.photo AS user_photo,
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
            LIMIT ? OFFSET ?
        ");

        $query->bindParam(1, $user_id, PDO::PARAM_INT);
        $query->bindParam(2, $limit, PDO::PARAM_INT);
        $query->bindParam(3, $offset, PDO::PARAM_INT);
        
        $query->execute();

        return $query->fetchAll();
    }

    public function getPostsByUser($user_id, $id, $limit, $offset) {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                u.user_id,
                u.photo AS user_photo,
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
            LIMIT ? OFFSET ?
        ");

        $query->bindParam(1, $user_id, PDO::PARAM_INT);
        $query->bindParam(2, $id, PDO::PARAM_INT);
        $query->bindParam(3, $limit, PDO::PARAM_INT);
        $query->bindParam(4, $offset, PDO::PARAM_INT);

        $query->execute();

        return $query->fetchAll();
    }

    public function getPostsByFollower($user_id, $follower_id) {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                u.user_id,
                u.photo AS user_photo,
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
                follows ON follows.followed_id = p.user_id
            LEFT JOIN
                likes ON likes.post_id = p.post_id AND likes.user_id = ?
            WHERE
                follows.follower_id = ?
            ORDER BY
                p.post_id DESC
            LIMIT 20
        ");

        $query->execute(
            [
                $user_id,
                $follower_id
            ]
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
                u.photo AS user_photo,
                c.name AS country
            FROM
                posts AS p
            INNER JOIN
                users AS u USING(user_id)
            INNER JOIN
                countries AS c USING(country_id)
            WHERE
                p.post_id = ?
        ");

        $query->execute(
            [$id]
        );

        return $query->fetch();
    }

    public function getPostsCount() {

        $query = $this->db->prepare("
            SELECT COUNT(*) AS posts_count
            FROM posts
        ");

        $query->execute();

        return $query->fetchAll();
    }

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

    public function getMostLikedPostsMonth($user_id) {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                u.user_id,
                u.photo AS user_photo,
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
                post_date > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -30 DAY)
            ORDER BY
                like_count DESC
            LIMIT 3 OFFSET 0
        ");

        $query->execute(
            [$user_id]
        );

        return $query->fetchAll();;
    }

    public function getMostLikedPostsWeek($user_id) {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                u.user_id,
                u.photo AS user_photo,
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
                post_date > DATE_ADD(CURRENT_TIMESTAMP, INTERVAL -7 DAY)
            ORDER BY
                like_count DESC
            LIMIT 3 OFFSET 0
        ");

        $query->execute(
            [$user_id]
        );

        return $query->fetchAll();;
    }

    public function searchPosts($user_id, $search) {

        $query = $this->db->prepare("
            SELECT
                p.post_id,
                p.title,
                p.content,
                p.photo,
                p.post_date,
                u.username,
                u.user_id,
                u.photo AS user_photo,
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
                p.title LIKE ?
                OR p.content LIKE ?
                OR u.username LIKE ?
            ORDER BY
                p.post_id DESC
            LIMIT 20 OFFSET 0
        ");

        $query->execute(
            [$user_id,
            "%".$search."%",
            "%".$search."%",
            "%".$search."%"]
        );

        return $query->fetchAll();;
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
            $data["filename"],
            $data["user_id"]
        ]);

        return $this->db->lastInsertId();
    }

    public function delete($id) {

        $query = $this->db->prepare("
            DELETE FROM posts
            WHERE post_id = ?
        ");

        $query->execute([$id]);
    }
}

?>