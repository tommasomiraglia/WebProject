<aside class="stories-sidebar mb-4">
    <div class="stories-wrapper d-flex overflow-auto">
        <div class="d-flex gap-2 w-100">

            <?php if(isset($templateParams["storie"]) && count($templateParams["storie"]) > 0): ?>
            <?php foreach($templateParams["storie"] as $storia): ?>
            <?php 
                $bgImage = $storia['postImage'];
                if (empty($bgImage)) {
                    $bgImage = 'https://picsum.photos/200/300';
                }
                $iconaGruppo = $storia['groupIcon'];
                if (!empty($iconaGruppo)) {
                    $groupAvatar = $iconaGruppo;
                } else {
                    $groupAvatar = '../assets/avatar/avatar0.png';
                }
                $titolo = $storia['title'];
                if(strlen($titolo) > 20) { 
                    $titolo = substr($titolo, 0, 20) . '...';
                }
            ?>

            <div class="card story-card rounded-4 text-white border-0 bg-dark" style="background-image: url('../<?php echo $bgImage; ?>');">

                <div class="c-shades"></div>

                <div class="card-body d-flex align-items-end">
                    <header class="c-header d-flex align-items-center w-100 pe-3">

                        <img src="../<?php echo $groupAvatar; ?>" class="card-image rounded-circle me-2 flex-shrink-0" alt="Logo del gruppo <?php echo htmlspecialchars($storia['name']); ?>">

                        <div class="overflow-hidden flex-grow-1">
                            <h6 class="mb-0 fw-bold text-truncate">
                                <a href="forum.php?id=<?php echo $storia['groupId']; ?>"
                                    class="text-decoration-none text-white shadow-sm">
                                    p/<?php echo htmlspecialchars($storia['name']); ?>
                                </a>
                            </h6>

                            <small class="c-subtitle text-light d-block text-truncate">
                                <?php echo htmlspecialchars($titolo); ?>
                            </small>
                        </div>
                    </header>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</aside>

<main class="posts-feed">

    <?php if(isset($templateParams["posts"]) && count($templateParams["posts"]) > 0): ?>
    <?php foreach($templateParams["posts"] as $post): ?>
    <?php 
        $postImg = $post['postImage'];
        $groupAvatar = $post['groupIcon'];
        if (empty($groupAvatar)) {
            $groupAvatar = '../assets/avatar/avatar0.jpg'; 
        }
        $dateObj = new DateTime($post['postDate']);
        $formattedDate = $dateObj->format('d/m/Y');
    ?>

    <article class="card rounded-4 border shadow-sm mb-3">
        <div class="card-body">

            <header class="d-flex align-items-center mb-2">
                <img src="../<?php echo $groupAvatar; ?>" class="group-avatar rounded-circle me-2"
                    alt="Avatar of <?php echo htmlspecialchars($post['username']); ?>">
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

            <h5 class="card-title fw-bold"><?php echo htmlspecialchars($post['title']); ?></h5>

            <?php if(!empty($postImg)): ?>
            <figure class="mb-3">
                <img src="../<?php echo $postImg; ?>" class="img-fluid rounded-3 w-100" alt="Immage releted to: <?php echo htmlspecialchars($post['title']); ?>">
            </figure>
            <?php endif; ?>

            <p class="card-text">
                <?php echo htmlspecialchars($post['longdescription']); ?>
            </p>

            <footer class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    <?php 
                        $upClass = ($post['userVote'] === 1) ? 'text-primary fw-bold' : '';
                        $downClass = ($post['userVote'] !== null && $post['userVote'] == 0) ? 'text-danger fw-bold' : '';
                    ?>
                    <div class="btn-group rounded-pill border" role="group" aria-label="Vote buttons">
                        <button class="btn btn-light btn-sm rounded-start-pill d-flex align-items-center gap-1"
                            aria-label="Upvote" onclick="votaPost(<?php echo $post['postId']; ?>, 1)">
                            <i class="bi bi-arrow-up-circle <?php echo $upClass; ?>"
                                id="upvote-icon-<?php echo $post['postId']; ?>"></i>
                            <span id="upvote-<?php echo $post['postId']; ?>"><?php echo $post['upvote']; ?></span>
                        </button>

                        <button class="btn btn-light btn-sm rounded-end-pill d-flex align-items-center gap-1"
                            aria-label="Downvote" onclick="votaPost(<?php echo $post['postId']; ?>, 0)">
                            <i class="bi bi-arrow-down-circle <?php echo $downClass; ?>"
                                id="downvote-icon-<?php echo $post['postId']; ?>"></i>
                            <span id="downvote-<?php echo $post['postId']; ?>"><?php echo $post['downvote']; ?></span>
                        </button>

                    </div>
                    <a href="comment.php?postId=<?php echo $post["postId"]?>"
                        class="btn btn-light btn-sm rounded-pill align-items-center gap-1">
                        <i class="bi bi-chat-left-text-fill"></i> Comments</a>
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
    <p class="text-center p-3">No posts to show.</p>
    <?php endif; ?>

</main>