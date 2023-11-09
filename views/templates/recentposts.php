<?php
    foreach($recentPosts as $recentPost) {
        echo '
            <article class="post-container">
                <div class="post" data-post_id="' .$recentPost["post_id"]. '">
                    <div class="content wrapper">
                        <a href="/postdetail/' .$recentPost["post_id"]. '"><img class="post-image" src="/images/posts/' .$recentPost["photo"]. ' " alt=""></a>
                        <h2 class="post-title">' .$recentPost["title"]. '</h2>
                        <p class="post-content">' .$recentPost["content"]. '</p>
                    </div>
                    <div class="post-signature">
                        <p class="post-date"><time>' .$recentPost["post_date"]. '</time></p>
                        <p class="post-author"><a href="/profile/' .$recentPost["user_id"]. '"><span class="username">' .$recentPost["username"]. '</span></a> - <span class="post-country">' .$recentPost["country"]. '</span></p>
                    </div>
                </div>
                <div>
                    <button id="likeBtn'.$recentPost["post_id"].'" type="button" data-user="' .$recentPost["liked"]. '" name="like">Like</button>
                    <p id="likeCount' .$recentPost["post_id"]. '"><span id="likesNumber' .$recentPost["post_id"]. '">' .$recentPost["like_count"]. '</span> likes</p>
                    <div><a href="/postdetail/' .$recentPost["post_id"]. '">Comment</a></div>
                    <p><Span>' .$recentPost["comments_count"]. '</span> comments</p>
                    <div><a href="/report_post/' .$recentPost["post_id"]. '">Report</a></div>
                </div>
            </article>
        ';
    }
?>