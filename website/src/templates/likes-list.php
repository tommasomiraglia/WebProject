<div class="container py-4">

    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-collection-play fs-1 me-3 text-secondary"></i>
        <h2 class="fw-bold mb-0">Liked Post</h2>
    </div>

    <?php if(empty($templateParams["posts"])): ?>
        
        <div class="alert alert-light text-center shadow-sm p-5 rounded-4 border-0">
            <div class="mb-3">
                <i class="bi bi-heartbreak fs-1 text-muted"></i>
            </div>
            <h4 class="fw-bold">You haven't liked any posts yet</h4>
            <p class="text-muted">Go back to the home page and show some appreciation!</p>
            <a href="index.php" class="btn btn-dark rounded-pill px-4 mt-2">Go to Feed</a>
        </div>

    <?php else: ?>

        <div class="row justify-content-center">
            <div class="col-lg-8"> <?php foreach($templateParams["posts"] as $post): ?>
                <?php 
                    $postImg = $post['postImage'];
                    $groupAvatar = !empty($post['groupIcon']) ? $post['groupIcon'] : 'assets/avatar/avatar0.jpg';
                    $dateObj = new DateTime($post['postDate']);
                    $formattedDate = $dateObj->format('d/m/Y');
                ?>

                <article class="card rounded-4 border shadow-sm mb-4">
                    <div class="card-body">

                        <header class="d-flex align-items-center mb-3">
                            <img src="../<?php echo $groupAvatar; ?>" class="rounded-circle me-2 object-fit-cover border" 
                                 width="40" height="40" alt="Avatar">
                            <div>
                                <h6 class="mb-0 fw-bold">
                                    <a href="forum.php?id=<?php echo $post['groupId']; ?>" class="text-decoration-none text-dark">
                                        p/<?php echo htmlspecialchars($post['groupName']); ?>
                                    </a>
                                </h6>
                                <time datetime="<?php echo $post['postDate']; ?>" class="text-muted small">
                                    <?php echo $formattedDate; ?>
                                </time>
                            </div>
                        </header>

                        <h5 class="card-title fw-bold mb-2">
                            <a href="comment.php?postId=<?php echo $post['postId']; ?>" class="text-decoration-none text-dark">
                                <?php echo htmlspecialchars($post['title']); ?>
                            </a>
                        </h5>

                        <?php if(!empty($postImg)): ?>
                        <figure class="mb-3">
                            <img src="../<?php echo $postImg; ?>" class="img-fluid rounded-3 w-100 object-fit-cover" 
                                 alt="Post Image" style="max-height: 500px;">
                        </figure>
                        <?php endif; ?>

                        <p class="card-text text-secondary">
                            <?php echo htmlspecialchars($post['longdescription']); ?>
                        </p>

                        <div class="mt-3 d-flex justify-content-end">
                            <a href="comment.php?postId=<?php echo $post["postId"]?>" 
                               class="btn btn-outline-dark rounded-pill btn-sm d-flex align-items-center gap-2">
                                <span>Go to the post</span>
                                <i class="bi bi-arrow-right"></i>
                            </a>
                        </div>
                        
                    </div>
                </article>
                <?php endforeach; ?>

            </div>
        </div>

    <?php endif; ?>
</div>