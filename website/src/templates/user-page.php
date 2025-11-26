<div class="container-sm py-3 custom-main-content">
    <div class="d-flex align-items-start mb-4">
        <?php $imgProfilo = '../assets/avatar/avatar0.jpg'; 
        if (!empty($templateParams["avatar"])) {
            $imgProfilo = '../' . $templateParams["avatar"];
        }
        ?>
        <div class="rounded-circle bg-warning flex-shrink-0 overflow-hidden" style="width: 60px; height: 60px;">
            <img src="<?php echo $imgProfilo; ?>" alt="Avatar" class="w-100 h-100 object-fit-cover"
                onerror="this.src='../assets/avatar/avatar0.jpg';">
        </div>
        <div class="ms-3 w-100">
            <h6 class="fw-bold mb-0">u/<?php echo $templateParams["username"];?></h6>
            <small class="text-muted">Description:</small>
            <div class="border rounded p-2 mt-1 text-muted small bg-light">
                <?php echo $templateParams["description"];?>
            </div>
        </div>
    </div>
    <hr class="my-4">
    <main class="posts-feed">
        <?php if(isset($templateParams["posts"]) && count($templateParams["posts"]) > 0): ?>
        <?php foreach($templateParams["posts"] as $post): ?>
        <?php
        $postImg = null;
        if (!empty($post['postImage'])) {
            if (strpos($post['postImage'], 'assets') === false) {
                $postImg = '../assets/post/' . $post['postImage'];
            } else {
                $postImg = '../' . $post['postImage'];
            }
        }
        $groupAvatar = '../assets/avatar/avatar0.jpg'; 
        if (!empty($post['groupIcon'])) {
            if (strpos($post['groupIcon'], 'assets') === false) {
                $groupAvatar = '../assets/avatar/' . $post['groupIcon'];
            } else {
                $groupAvatar = '../' . $post['groupIcon'];
            }
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
                    <img src="<?php echo $groupAvatar; ?>" class="rounded-circle me-2" width="40" height="40"
                        alt="Group Icon">
                    <div>
                        <h6 class="mb-0 fw-bold">
                            <a href="forum.php?id=<?php echo $post['groupId']; ?>"
                                class="text-decoration-none text-dark">
                                p/<?php echo htmlspecialchars($post['groupName']); ?>
                            </a>
                        </h6>
                        <time datetime="<?php echo $post['postDate']; ?>" class="text-muted small">
                            <?php echo $formattedDate; ?>
                        </time>
                    </div>
                </header>

                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($post['title']); ?></h5>

                <?php if($postImg !== null && file_exists(str_replace('../', '', $postImg))): ?>
                <figure class="mb-3">
                    <img src="<?php echo $postImg; ?>" class="img-fluid rounded-3 w-100" alt="Post Image">
                </figure>
                <?php elseif($postImg !== null): ?>
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
                                <span id="upvote-<?php echo $post['postId']; ?>">
                                    <?php echo $post['upvote'] ?? 0; ?>
                                </span>
                            </button>

                            <button class="btn btn-light btn-sm rounded-end-pill d-flex align-items-center gap-1"
                                aria-label="Downvote" onclick="votaPost(<?php echo $post['postId']; ?>, 0)">
                                <i class="bi bi-arrow-down-circle <?php echo $downClass; ?>"
                                    id="downvote-icon-<?php echo $post['postId']; ?>"></i>
                                <span id="downvote-<?php echo $post['postId']; ?>">
                                    <?php echo $post['downvote'] ?? 0; ?>
                                </span>
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
            <p class="text-muted">User hasn't posted anything yet.</p>
        </div>
        <?php endif; ?>
    </main>
</div>