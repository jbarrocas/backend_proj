<?php

require_once("base.php");

class User_Restrictions extends Base{

    public function createPostUserRestriction($post_author, $post_id) {

        $query = $this->db->prepare("
            INSERT INTO user_restrictions
            (restricted_id, post_id)
            VALUES(?, ?)
        ");

        $query->execute([
            $post_author,
            $post_id
        ]);
    }
}

?>