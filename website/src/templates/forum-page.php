<div class="bg-light">
    <div id="sidebar-overlay" class="sidebar-overlay"></div>
    <div class="container-sm py-3 custom-main-content">
        <!--FORUM INFORMATION-->
        <div class="d-flex align-items-start mb-4">
            <div class="rounded-circle bg-warning flex-shrink-0 overflow-hidden" style="width: 60px; height: 60px;">
                <img src="../<?php echo $templateParams["avatar"];?>" alt="Avatar" class="w-100 h-100 object-fit-cover">
            </div>

            <div class="ms-3 w-100">
                <h6 class="fw-bold mb-0">p/<?php echo $templateParams["name"];?></h6>
                <small class="text-muted">Description:</small>

                <div class="border rounded p-2 mt-1 text-muted small bg-light">
                    <?php echo $templateParams["description"];?>
                </div>
            </div>

        </div>
        <div class="d-flex justify-content-between align-items-end mt-5">
            <div>
                <div class="text-muted fs-5">Members:</div>
                <div class="display-6 fw-normal"><?php echo $templateParams["memberCount"];?></div>
            </div>

            <div class="d-flex gap-2">
                <button class="btn text-white px-4 py-2 rounded-3" style="background-color: #8B3635;">
                    Join
                </button>
            </div>
        </div>
        <!--FORUM POST-->
        <hr class="my-4">
        <main class="posts-feed">

            <?php if(isset($templateParams["posts"]) && count($templateParams["posts"]) > 0): ?>
            <?php foreach($templateParams["posts"] as $post): ?>
            <?php 
        $postImg = null;
        if (!empty($post['postImage'])) {
            $postImg = '../' . $post['postImage'];
        }
        $dbAvatar = $post['avatar'] ?? null; 
        
        if (!empty($dbAvatar)) {
            $userAvatar = '../' . $dbAvatar;
        } else {
            $userAvatar = '../assets/avatar/avatar0.jpg'; 
        }
        $dateObj = new DateTime($post['postDate']);
        $formattedDate = $dateObj->format('d/m/Y');
        $vote = $post['userVote'] ?? null;
        $upClass = ($vote === 1) ? 'text-primary fw-bold' : '';
        $downClass = ($vote !== null && $vote == 0) ? 'text-danger fw-bold' : '';
    ?>

            <article class="card rounded-4 border shadow-sm mb-3">
                <div class="card-body">

                    <header class="d-flex align-items-center mb-2">
                        <img src="<?php echo $userAvatar; ?>" class="rounded-circle me-2" width="40" height="40"
                            alt="Avatar" style="object-fit: cover;">
                        <div>
                            <h6 class="mb-0 fw-bold">
                                <a href="user.php?id=<?php echo $post['userId']; ?>"
                                    class="text-decoration-none text-dark">
                                    u/<?php echo htmlspecialchars($post['username']); ?>
                                </a>
                            </h6>
                            <time datetime="<?php echo $post['postDate']; ?>" class="text-muted small">
                                <?php echo $formattedDate; ?>
                            </time>
                        </div>
                    </header>

                    <h5 class="card-title fw-bold"><?php echo htmlspecialchars($post['title']); ?></h5>

                    <?php if($postImg !== null): ?>
                    <figure class="mb-3">
                        <img src="<?php echo $postImg; ?>" class="img-fluid rounded-3 w-100" alt="Post Image">
                    </figure>
                    <?php endif; ?>

                    <p class="card-text">
                        <?php echo htmlspecialchars($post['longdescription']); ?>
                    </p>

                    <footer class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <div class="btn-group rounded-pill border" role="group" aria-label="Vote buttons">

                                <button class="btn btn-light btn-sm rounded-start-pill d-flex align-items-center gap-1"
                                    aria-label="Upvote" onclick="votaPost(<?php echo $post['postId']; ?>, 1)">
                                    <i class="bi bi-arrow-up-circle <?php echo $upClass; ?>"
                                        id="upvote-icon-<?php echo $post['postId']; ?>"></i>
                                    <span
                                        id="upvote-<?php echo $post['postId']; ?>"><?php echo $post['upvote']; ?></span>
                                </button>

                                <button class="btn btn-light btn-sm rounded-end-pill d-flex align-items-center gap-1"
                                    aria-label="Downvote" onclick="votaPost(<?php echo $post['postId']; ?>, 0)">
                                    <i class="bi bi-arrow-down-circle <?php echo $downClass; ?>"
                                        id="downvote-icon-<?php echo $post['postId']; ?>"></i>
                                    <span
                                        id="downvote-<?php echo $post['postId']; ?>"><?php echo $post['downvote']; ?></span>
                                </button>

                            </div>
                            <button class="btn btn-light btn-sm rounded-pill fw-bold">Load Comments</button>
                        </div>

                        <div class="dropup">
                            <button class="btn btn-light btn-sm border-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-label="More options">
                                <i class="bi bi-three-dots"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center text-danger" href="#"
                                        onclick="segnalaPost(<?php echo $post['postId']; ?>); return false;">
                                        <i class="bi bi-exclamation-circle me-2 fs-5"></i>
                                        <span>Report</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </footer>
                </div>
            </article>
            <?php endforeach; ?>
            <?php else: ?>
            <div class="text-center py-5">
                <h3>No posts yet in this group.</h3>
                <p class="text-muted">Be the first to share something!</p>
            </div>
            <?php endif; ?>

        </main>
    </div>
</div>