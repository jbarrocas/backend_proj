<?php
    foreach($mostLikedPosts as $mostLikedPost) {
        echo '
            <article class="post-container">
                <div class="post" data-post_id="' .$mostLikedPost["post_id"]. '">
                    <div class="content wrapper">
                        <a href="/postdetail/' .$mostLikedPost["post_id"]. '"><img class="post-image" src="/images/posts/' .$mostLikedPost["photo"]. ' " alt=""></a>
                        <h2 class="post-title">' .$mostLikedPost["title"]. '</h2>
                        <p class="post-content">' .$mostLikedPost["content"]. '</p>
                    </div>
                    <div class="post-signature">
                        <p class="post-date"><time>' .$mostLikedPost["post_date"]. '</time></p>
                        <p class="post-author"><a href="/profile/' .$mostLikedPost["user_id"]. '"><span class="username">' .$mostLikedPost["username"]. '</span></a> - <span class="post-country">' .$mostLikedPost["country"]. '</span></p>
                    </div>
                </div>
                <div>
                    <button id="likeBtn'.$mostLikedPost["post_id"].'" type="button" data-user="' .$mostLikedPost["liked"]. '" name="like">Like</button>
                    <p id="likeCount' .$mostLikedPost["post_id"]. '"><span id="likesNumber' .$mostLikedPost["post_id"]. '">' .$mostLikedPost["like_count"]. '</span> likes</p>
                    <div><a href="/postdetail/' .$mostLikedPost["post_id"]. '">Comment</a></div>
                    <p><Span>' .$mostLikedPost["comments_count"]. '</span> comments</p>
                    <div><a href="/report_post/' .$mostLikedPost["post_id"]. '">Report</a></div>
                </div>
            </article>
        ';
    }
?>