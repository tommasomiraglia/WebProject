<div class="container py-4">
    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-collection-play fs-1 me-3 text-secondary"></i>
        <h1 class="fw-bold mb-0 h2">Liked Posts</h1>
    </div>

    <?php if(empty($templateParams["posts"])): ?>
        <div class="alert alert-light text-center shadow-sm p-5 rounded-4 border-0">
            <div class="mb-3">
                <i class="bi bi-heartbreak fs-1 text-muted"></i>
            </div>
            <h2 class="fw-bold h4">You haven't liked any posts yet</h2>
            <p class="text-muted">Go back to the home page and show some appreciation!</p>
            <a href="index.php" class="btn btn-dark rounded-pill px-4 mt-2">Go to Feed</a>
        </div>
    <?php else: ?>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <?php foreach($templateParams["posts"] as $post): ?>
                    <?php 
                        // Protezione contro dati mancanti per evitare errori PHP nel layout
                        $postId = $post['postId'] ?? 0;
                        $postImg = $post['postImage'] ?? '';
                        $groupAvatar = !empty($post['groupIcon']) ? $post['groupIcon'] : 'assets/avatar/avatar0.jpg';
                        $groupName = $post['groupName'] ?? 'Unknown';
                        $postTitle = $post['title'] ?? 'No Title';
                        
                        $dateObj = new DateTime($post['postDate'] ?? 'now');
                        $formattedDate = $dateObj->format('d/m/Y');
                    ?>

                    <article class="card rounded-4 border shadow-sm mb-4 position-relative">
                        <div class="card-body">
                            <header class="d-flex align-items-center mb-3">
                                <img src="../<?php echo htmlspecialchars($groupAvatar); ?>"
                                     class="rounded-circle me-2 object-fit-cover border" 
                                     width="40" height="40" alt="">
                                <div>
                                    <h2 class="mb-0 fw-bold h6">
                                        <a href="forum.php?id=<?php echo $post['groupId'] ?? ''; ?>" 
                                           class="text-decoration-none text-dark position-relative" style="z-index: 2;">
                                            p/<?php echo htmlspecialchars($groupName); ?>
                                        </a>
                                    </h2>
                                    <time datetime="<?php echo $post['postDate'] ?? ''; ?>" class="text-muted small">
                                        <?php echo $formattedDate; ?>
                                    </time>
                                </div>
                            </header>

                            <h3 class="card-title h5 fw-bold mb-2">
                                <a href="comment.php?postId=<?php echo $postId; ?>"
                                   class="text-decoration-none text-dark stretched-link">
                                    <?php echo htmlspecialchars($postTitle); ?>
                                </a>
                            </h3>

                            <?php if(!empty($postImg)): ?>
                                <figure class="mb-3">
                                    <img src="../<?php echo htmlspecialchars($postImg); ?>"
                                         class="img-fluid rounded-3 w-100 object-fit-cover"
                                         alt="Image for <?php echo htmlspecialchars($postTitle); ?>"
                                         style="max-height: 500px;">
                                </figure>
                            <?php endif; ?>

                            <p class="card-text text-secondary">
                                <?php echo htmlspecialchars($post['longdescription'] ?? ''); ?>
                            </p>

                            <div class="mt-3 d-flex justify-content-end">
                                <div class="btn btn-outline-dark rounded-pill btn-sm d-flex align-items-center gap-2" 
                                     aria-hidden="true">
                                    <span>Go to the post</span>
                                    <i class="bi bi-arrow-right"></i>
                                </div>
                            </div>
                        </div>
                    </article>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endif; ?>
</div>