<?php
    foreach($posts as $post) {
        echo '
            <article class="post-container">
                <div class="post" name="post" id="post" data-post_id="' .$post["post_id"]. '" data-user_id="' .$post["user_id"]. '" data-session_id="' .$_SESSION["user_id"]. '">
                    <div class="content-wrapper">
                        <a href="/postdetail/' .$post["post_id"]. '"><img class="post-image" src="/images/posts/' .$post["photo"]. '" alt=""></a>
                        <h2 class="post-title">' .$post["title"]. '</h2>
                        <p class="post-content">' .$post["content"]. '</p>
                    </div>
                    <div class="post-signature">
                        <p class="post-date"><time>' .$post["post_date"]. '</time></p>
                        <div class="author">
                            <figure>
                                <img class="user-photo" src="/images/users/' .$post["user_photo"]. '">
                            </figure>
                            <p class="post-author"><a href="/profile/' .$post["user_id"]. '"><span class="username">' .$post["username"]. '</span></a> - <span class="post-country">' .$post["country"]. '</span></p>
                        </div>
                    </div>
                </div>
                <div class="action">
                    <button class="like-button" id="likeBtn'.$post["post_id"].'" type="button" data-user="' .$post["liked"]. '" name="like">Like</button>
                    <p id="likeCount' .$post["post_id"]. '">Likes <span id="likesNumber' .$post["post_id"]. '">' .$post["like_count"]. '</span></p>
                    <a href="/postdetail/' .$post["post_id"]. '"><div class="comment-button">Comment</div></a>
                    <p>Comments <Span>' .$post["comments_count"]. '</span></p>
                    <a href="/report_post/' .$post["post_id"]. '"><div class="report-button" id="reportPostBtn">Report</div></a>
                    <button class="delete-button" id="deletePostBtn" type="button" name="delete">Delete Post</button>
                </div>
            </article>
        ';
    }
?>