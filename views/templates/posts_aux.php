<?php
    foreach($post_auxs as $post_aux) {
        echo '
            <article class="post-container">
                <div class="post" name="post" id="post" data-post_id="' .$post_aux["post_id"]. '" data-user_id="' .$post_aux["user_id"]. '" data-session_id="' .$_SESSION["user_id"]. '">
                    <div class="content wrapper">
                        <a href="/postdetail/' .$post_aux["post_id"]. '"><img class="post-image" src="/images/posts/' .$post_aux["photo"]. ' " alt=""></a>
                        <h2 class="post-title">' .$post_aux["title"]. '</h2>
                        <p class="post-content">' .$post_aux["content"]. '</p>
                    </div>
                    <div class="post-signature">
                        <p class="post-date"><time>' .$post_aux["post_date"]. '</time></p>
                        <p class="post-author"><a href="/profile/' .$post_aux["user_id"]. '"><span class="username">' .$post_aux["username"]. '</span></a> - <span class="post-country">' .$post_aux["country"]. '</span></p>
                    </div>
                </div>
                <div>
                    <button id="likeBtn'.$post_aux["post_id"].'" type="button" data-user="' .$post_aux["liked"]. '" name="like">Like</button>
                    <p id="likeCount' .$post_aux["post_id"]. '">Likes <span id="likesNumber' .$post_aux["post_id"]. '">' .$post_aux["like_count"]. '</span></p>
                    <div><a href="/postdetail/' .$post_aux["post_id"]. '">Comment</a></div>
                    <p>Comments <Span>' .$post_aux["comments_count"]. '</span></p>
                    <div id="reportPostBtn"><a href="/report_post/' .$post_aux["post_id"]. '">Report</a></div>
                    <button id="deletePostBtn" type="button" name="delete">Delete Post</button>
                </div>
            </article>
        ';
    }
?>