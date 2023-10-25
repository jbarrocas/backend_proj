<?php

require_once("base.php");

class Likes extends Base
{

    public function getLikesByPostAndUser($post_id, $user_id) {
        $query = $this->db->prepare("
            SELECT 
                COUNT(*) AS total_count,
                post_id, user_id
            FROM
                likes
            WHERE
               post_id = ? AND user_id = ?
        ");

        $query->execute([$post_id, $user_id]);

        return $query->fetch();
    }

    public function createLike($post_id, $user_id) {

        $query = $this->db->prepare("
            INSERT INTO likes
            (post_id, user_id)
            VALUES(?,?)
        ");

        $query->execute([
            $post_id,
            $user_id
        ]);
    }

    public function deleteLike($post_id, $user_id) {

        $query = $this->db->prepare("
            DELETE FROM
                likes
            WHERE
                post_id = ? AND user_id = ?
        ");

        $query->execute([
            $post_id,
            $user_id
        ]);
    }
}

?>