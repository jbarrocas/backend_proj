<?php
    foreach($postAuxs as $postAux) {
        echo '
            <article class="post-container">
                <div class="post" name="post" id="post" data-post_id="' .$postAux["post_id"]. '" data-user_id="' .$postAux["user_id"]. '" data-session_id="' .$_SESSION["user_id"]. '">
                    <div class="content wrapper">
                        <a href="/postdetail/' .$postAux["post_id"]. '"><img class="post-image" src="/images/posts/' .$postAux["photo"]. ' " alt=""></a>
                        <h2 class="post-title">' .$postAux["title"]. '</h2>
                        <p class="post-content">' .$postAux["content"]. '</p>
                    </div>
                    <div class="post-signature">
                        <p class="post-date"><time>' .$postAux["post_date"]. '</time></p>
                        <div class="author">
                            <figure>
                                <img class="user-photo" src="/images/users/' .$postAux["user_photo"]. '">
                            </figure>
                            <p class="post-author"><a href="/profile/' .$postAux["user_id"]. '"><span class="username">' .$postAux["username"]. '</span></a> - <span class="post-country">' .$postAux["country"]. '</span></p>
                        </div>
                    </div>
                </div>
                <div class="action">
                    <button class="like-button" id="likeBtn'.$postAux["post_id"].'" type="button" data-user="' .$postAux["liked"]. '" name="like">Like</button>
                    <p id="likeCount' .$postAux["post_id"]. '">Likes <span id="likesNumber' .$postAux["post_id"]. '">' .$postAux["like_count"]. '</span></p>
                    <a href="/postdetail/' .$postAux["post_id"]. '"><div class="comment-button">Comment</div></a>
                    <p>Comments <Span>' .$postAux["comments_count"]. '</span></p>
                    <a href="/report_post/' .$postAux["post_id"]. '"><div class="report-button" id="reportPostBtn">Report</div></a>
                    <button class="delete-button" id="deletePostBtn" type="button" name="delete">Delete Post</button>
                </div>
            </article>
        ';
    }
?>