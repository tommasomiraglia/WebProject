<div class="container-sm py-3 custom-main-content">

    <?php if(isset($templateParams["error"])): ?>
    <div class="alert alert-danger p-4 rounded-4 shadow-sm text-center">
        <h3><?php echo $templateParams["error"]; ?></h3>
        <a href="index.php" class="btn btn-dark mt-2 rounded-pill">Back to Home</a>
    </div>
    <?php else: ?>

    <?php 
        $post = $templateParams["post"];
        $postImg = null;
        if (!empty($post['postImage'])) {
            $postImg = (strpos($post['postImage'], 'assets') === false) 
                ? '../assets/post/' . $post['postImage'] 
                : '../' . $post['postImage'];
        }
        $groupAvatar = '../assets/avatar/avatar0.jpg'; 
        if (!empty($post['groupIcon'])) {
            $groupAvatar = (strpos($post['groupIcon'], 'assets') === false) 
                ? '../assets/avatar/' . $post['groupIcon'] 
                : '../' . $post['groupIcon'];
        }
        $dateObj = new DateTime($post['postDate']);
        $formattedDate = $dateObj->format('d/m/Y H:i');
        $vote = $post['userVote'] ?? null;
        $upClass = ($vote === 1) ? 'text-primary fw-bold' : '';
        $downClass = ($vote !== null && $vote == 0) ? 'text-danger fw-bold' : '';
    ?>
    <main class="posts-feed mb-4">
        <article class="card rounded-4 border shadow-sm">
            <div class="card-body">
                <header class="d-flex align-items-center mb-2">
                    <img src="<?php echo $groupAvatar; ?>" class="rounded-circle me-2" width="40" height="40" alt=""
                        onerror="this.src='../assets/avatar/avatar0.jpg';">
                    <div>
                        <h6 class="mb-0 fw-bold">
                            <a href="forum.php?id=<?php echo $post['groupId']; ?>"
                                class="text-decoration-none text-dark">
                                p/<?php echo htmlspecialchars($post['groupName']); ?>
                            </a>
                        </h6>

                        <small class="text-muted d-flex align-items-center">
                            <span>Posted by</span>

                            <a href="user.php?id=<?php echo $post['userId']; ?>"
                                class="text-decoration-none text-muted fw-semibold ms-1">
                                u/<?php echo htmlspecialchars($post['username']); ?>
                            </a>

                            <span class="mx-1">•</span>

                            <time datetime="<?php echo $post['postDate']; ?>">
                                <?php echo $formattedDate; ?>
                            </time>
                        </small>
                    </div>
                </header>
                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($post['title']); ?></h5>
                <?php if($postImg !== null): ?>
                <figure class="mb-3">
                    <img src="<?php echo $postImg; ?>" class="img-fluid rounded-3 w-100"
                        alt="Immage releted to: <?php echo htmlspecialchars($post['title']); ?>">
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
                    </div>

                    <div class="dropup">
                        <button class="btn btn-light btn-sm border-0" type="button" data-bs-toggle="dropdown"
                            aria-expanded="false" aria-label="Other option">
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
    </main>

    <div class="card rounded-4 border shadow-sm mb-4">
        <div class="card-body">
            <?php if(isset($_SESSION['userid'])): ?>
            <form action="comment.php?postId=<?php echo $post['postId']; ?>" method="POST">
                <div class="d-flex gap-2 align-items-start">
                    <?php 
                            $myAvatar = $_SESSION['avatar'] ?? '';
                            $myAvatarPath = (!empty($myAvatar)) ? '../assets/avatar/' . basename($myAvatar) : '../assets/avatar/avatar0.jpg';
                        ?>
                    <img src="<?php echo $myAvatarPath; ?>" class="rounded-circle" width="40" height="40" alt="Me"
                        onerror="this.src='../assets/avatar/avatar0.jpg';">

                    <div class="w-100">
                        <textarea class="form-control rounded-4 bg-light border-0" name="testoCommento" rows="2"
                            placeholder="What are your thoughts?" aria-label="Scrivi un commento" required></textarea>
                        <div class="text-end mt-2">
                            <button type="submit" class="btn btn-dark rounded-pill px-4 fw-bold">Reply</button>
                        </div>
                    </div>
                </div>
            </form>
            <?php else: ?>
            <div class="text-center py-2">
                <p class="mb-2 text-muted">Log in to join the conversation</p>
                <a href="login.php" class="btn btn-outline-dark rounded-pill btn-sm px-4">Log In</a>
            </div>
            <?php endif; ?>
        </div>
    </div>

    <hr class="my-4">

    <div class="container mt-4" style="max-width: 600px;">

        <?php if(isset($templateParams["noComment"])): ?>
        <div class="text-center text-muted py-4">
            <i class="bi bi-chat-square-dots fs-1 d-block mb-2"></i>
            <p><?php echo $templateParams["noComment"]; ?></p>
        </div>
        <?php else: ?>

        <h5 class="mb-4 fw-bold">All Comments</h5>

        <?php foreach($templateParams["comments"] as $comment): ?>
        <?php 
            $commAvatar = '../assets/avatar/avatar0.jpg';
            if (!empty($comment['avatar'])) {
                $commAvatar = (strpos($comment['avatar'], 'assets') === false) 
                    ? '../assets/avatar/' . $comment['avatar'] 
                    : '../' . $comment['avatar'];
            }
        ?>
        <div class="d-flex align-items-start gap-2 mb-3">
            <img src="<?php echo $commAvatar; ?>" class="rounded-circle flex-shrink-0" width="40" height="40" alt=""
                style="object-fit: cover;" onerror="this.src='../assets/avatar/avatar0.jpg';">

            <div class="bg-light p-3 rounded-4 w-100 border">
                <div class="d-flex justify-content-between align-items-center mb-1">
                    <a href="user.php?id=<?php echo $comment['userId']; ?>&c=<?php echo $comment['commentId']; ?>"
                        class="fw-bold text-dark text-decoration-none small">
                        <?php echo htmlspecialchars($comment["username"]); ?>
                    </a>
                </div>
                <p class="mb-0 text-break" style="font-size: 0.95rem; line-height: 1.4;">
                    <?php echo nl2br(htmlspecialchars($comment["longdescription"])); ?>
                </p>
            </div>
        </div>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>

    <?php endif; ?>
</div>