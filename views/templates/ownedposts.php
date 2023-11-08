<?php
    foreach($recentPostsByUsers as $recentPostsByUser) {
        echo '
            <article class="post-container">
                <div class="post" data-post_id="' .$recentPostsByUser["post_id"]. '">
                    <div class="content wrapper">
                        <a href="/postdetail/' .$recentPostsByUser["post_id"]. '"><img class="post-image" src="/images/posts/' .$recentPostsByUser["photo"]. ' " alt=""></a>
                        <h2 class="post-title">' .$recentPostsByUser["title"]. '</h2>
                        <p class="post-content">' .$recentPostsByUser["content"]. '</p>
                    </div>
                    <div class="post-signature">
                        <p class="post-date"><time>' .$recentPostsByUser["post_date"]. '</time></p>
                        <p class="post-author"><a href="/profile/' .$recentPostsByUser["user_id"]. '"><span class="username">' .$recentPostsByUser["username"]. '</span></a> - <span class="post-country">' .$recentPostsByUser["country"]. '</span></p>
                    </div>
                </div>
                <div>
                    <button id="likeBtn'.$recentPostsByUser["post_id"].'" type="button" data-user="' .$recentPostsByUser["liked"]. '" name="like">Like</button>
                    <p id="likeCount' .$recentPostsByUser["post_id"]. '"><span id="likesNumber' .$recentPostsByUser["post_id"]. '">' .$recentPostsByUser["like_count"]. '</span> likes</p>
                    <div><a href="/postdetail/' .$recentPostsByUser["post_id"]. '">Comment</a></div>
                    <p><Span>' .$recentPostsByUser["comments_count"]. '</span> comments</p>
                    <button id="deletePostBtn" type="button" name="delete">Delete Post</button>
                </div>
            </article>
        ';
    }
?>