    <div class="container-sm py-3 custom-main-content">
        <main class="posts-feed">
            <?php if(isset($templateParams["error"])):?>
                <h3><?php echo $templateParams["error"];?></h3>
            <?php else:?>
            <article class="card rounded-4 border shadow-sm mb-3">
                <div class="card-body">
                    <header class="d-flex align-items-center mb-2">
                        <img src="../<?php echo $templateParams["post"]["avatar"]?>" class="rounded-circle me-2" width="40" height="40"
                            alt="Avatar">
                        <div>
                            <h6 class="mb-0 fw-bold">
                                <a href="forum.php?groupId=<?php echo $templateParams["post"]["groupId"]?>" class="text-decoration-none text-dark">
                                    <?php echo $templateParams["post"]["name"]?>
                                </a>
                            </h6>
                            <time datetime="2025-10-24" class="text-muted small"><?php echo $templateParams["post"]["postDate"]?></time>
                        </div>
                    </header>

                    <h5 class="card-title fw-bold"><?php echo $templateParams["post"]["title"]?></h5>

                    <figure class="mb-3">
                        <img src="../<?php echo $templateParams["post"]["postImage"]?>" class="img-fluid rounded-3 w-100" alt="Coding laptop">
                    </figure>

                    <p class="card-text"><?php echo $templateParams["post"]["longdescription"]?></p>

                    <footer class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <div class="btn-group rounded-pill border" role="group" aria-label="Vote buttons">
                                <button class="btn btn-light btn-sm rounded-start-pill d-flex align-items-center gap-1"
                                aria-label="Upvote" onclick="votaPost(<?php echo $templateParams['post']['postId']; ?>, 1)">
                                <i class="bi bi-arrow-up-circle <?php echo $upClass; ?>"
                                    id="upvote-icon-<?php echo $templateParams['post']['postId']; ?>"></i>
                                <span id="upvote-<?php echo $templateParams['post']['postId']; ?>">
                                    <?php echo $templateParams['post']['upvote'] ?? 0; ?>
                                </span>
                                </button>
                                <button class="btn btn-light btn-sm rounded-end-pill d-flex align-items-center gap-1"
                                aria-label="Downvote" onclick="votaPost(<?php echo $templateParams['post']['postId']; ?>, 0)">
                                <i class="bi bi-arrow-down-circle <?php echo $downClass; ?>"
                                    id="downvote-icon-<?php echo $templateParams['post']['postId']; ?>"></i>
                                <span id="downvote-<?php echo $templateParams['post']['postId']; ?>">
                                    <?php echo $templateParams['post']['downvote'] ?? 0; ?>
                                </span>
                            </button>
                            </div>
                            <a href="#" class="btn btn-light btn-sm rounded-pill">
                                <i class="bi bi-chat"></i>
                            </a>
                        </div>
                        <div class="dropup">

                            <button class="btn btn-light btn-sm border-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-label="More options">
                                <i class="bi bi-three-dots"></i>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li>
                                    <a class="dropdown-item d-flex align-items-center" href="#">
                                        <i class="bi bi-exclamation-circle me-2 fs-5"></i>
                                        <span>Report</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </footer>
                </div>
            </article>
            <hr class="my-4">
            <div class="container mt-4" style="max-width: 600px;">
                <?php if(isset($templateParams["noComment"])):?>
                    <h3><?php echo $tempalteParams["noComment"];?></h3>
                <?php else:?>
                <?php foreach($templateParams["comments"] as $comment):?>
                <div class="d-flex mb-4">
                    <img src="../<?php echo $comment["avatar"]?>"
                        class="rounded-circle me-3" width="50" height="50" alt="Avatar">
                    <div>
                        <div class="fw-bold"><?php echo $comment["username"]?></div>
                        <p class="mb-1"><?php echo $comment["longdescription"]?></p>
                    </div>
                </div>
                <?php endforeach;?>
                <?php endif;?>
            </div>
    </div>
        <?php endif;?>
    </div>
