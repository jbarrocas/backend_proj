<?php

require_once("base.php");

class Follows extends Base
{

    public function getFollowersById($id) {

        $query = $this->db->prepare("
            SELECT 
                COUNT(*) AS total_count
            FROM
                follows
            WHERE
               followed_id = ?
        ");

        $query->execute([$id]);

        return $query->fetch();
    }

    public function getFollowsById($id) {

        $query = $this->db->prepare("
            SELECT 
                COUNT(*) AS total_count
            FROM
                follows
            WHERE
               follower_id = ?
        ");

        $query->execute([$id]);

        return $query->fetch();
    }

    public function getFollowerByFollowed($followed_id, $follower_id) {

        $query = $this->db->prepare("
            SELECT 
                follower_id
            FROM
                follows
            WHERE
               followed_id = ? AND follower_id = ?
        ");

        $query->execute([
            $followed_id,
            $follower_id
        ]);

        return $query->fetch();
    }

    public function createFollow($followed_id, $follower_id) {

        $query = $this->db->prepare("
            INSERT INTO follows
            (followed_id, follower_id)
            VALUES(?, ?)
        ");

        $query->execute([
            $followed_id,
            $follower_id
        ]);
    }

    public function deleteFollow($followed_id, $follower_id) {

        $query = $this->db->prepare("
            DELETE FROM
                follows
            WHERE
                followed_id = ? AND follower_id = ?
        ");

        $query->execute([
            $followed_id,
            $follower_id
        ]);
    }
}

?>