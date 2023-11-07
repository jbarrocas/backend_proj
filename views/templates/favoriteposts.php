<?php
    foreach($favoritePosts as $favoritePost) {
        echo '
        <article class="post-container">
            <div class="post" data-post_id="' .$favoritePost["post_id"]. '">
                <div class="content wrapper">
                    <a href="/postdetail/' .$favoritePost["post_id"]. '"><img class="post-image" src="/images/posts/' .$favoritePost["photo"]. ' " alt=""></a>
                    <h2 class="post-title">' .$favoritePost["title"]. '</h2>
                    <p class="post-content">' .$favoritePost["content"]. '</p>
                </div>
                <div class="post-signature">
                    <p class="post-date"><time>' .$favoritePost["post_date"]. '</time></p>
                    <p class="post-author"><a href="/profile/' .$favoritePost["user_id"]. '"><span class="username">' .$favoritePost["username"]. '</span></a> - <span class="post-country">' .$favoritePost["country"]. '</span></p>
                </div>
            </div>
            <div>
                <button id="likeBtn'.$favoritePost["post_id"].'" type="button" data-user="' .$favoritePost["liked"]. '" name="like" aria-label="Like">Like</button>
                <p id="likeCount' .$favoritePost["post_id"]. '"><span id="likesNumber' .$favoritePost["post_id"]. '">' .$favoritePost["like_count"]. '</span> likes</p>
                <div><a href="/postdetail/' .$favoritePost["post_id"]. '">Comment</a></div>
                <p><Span>' .$favoritePost["comments_count"]. '</span> comments</p>
                <button id="deletePostBtn" type="button" name="delete" aria-label="Delete Post">Delete Post</button>
            </div>
        </article>
        ';
    }
?>