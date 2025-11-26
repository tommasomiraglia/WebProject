<div class="bg-light">
    <!-- Overlay -->
<div id="sidebar-overlay" class="sidebar-overlay"></div>
    <div class="container-sm py-3 custom-main-content">

        <!--FORUM INFORMATION-->
        <div class="d-flex align-items-start mb-4">
            <div class="rounded-circle bg-warning flex-shrink-0 overflow-hidden" style="width: 60px; height: 60px;">
                <img src="../../<?php echo $templateParams["avatar"];?>" alt="Avatar" class="w-100 h-100 object-fit-cover">
            </div>

            <div class="ms-3 w-100">
                <h6 class="fw-bold mb-0"><?php echo $templateParams["name"];?></h6>
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
        <!--FORUM POSTS-->
        <hr class="my-4">
        <main class="posts-feed">
            <?php if(!empty($templateParams["posts"])):?>
            <?php foreach($templateParams["posts"] as $post):?>
            <article class="card rounded-4 border shadow-sm mb-3">
                <div class="card-body">
                    <header class="d-flex align-items-center mb-2">
                        <img src="<?php echo $post["avatar"];?>" class="rounded-circle me-2" width="40" height="40"
                            alt="Avatar">
                        <div>
                            <h6 class="mb-0 fw-bold">
                                <a href="user.php/id=<?php echo $post["userId"]?>" class="text-decoration-none text-dark">
                                    <?php echo $post["username"]?>
                                </a>
                            </h6>
                            <time datetime="2025-10-24" class="text-muted small"><?php echo $post["postDate"];?></time>
                        </div>
                    </header>

                    <h5 class="card-title fw-bold"><?php echo $post["title"];?></h5>

                    <figure class="mb-3">
                        <img src="<?php echo $post["postImage"];?>" class="img-fluid rounded-3 w-100" alt="Coding laptop">
                    </figure>

                    <p class="card-text"><?php echo $post["longdescription"];?></p>

                    <footer class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <div class="btn-group rounded-pill border" role="group" aria-label="Vote buttons">
                                <button class="btn btn-light btn-sm rounded-start-pill" aria-label="Upvote">
                                    <i class="bi bi-arrow-up-circle"></i>
                                </button>
                                <button class="btn btn-light btn-sm rounded-end-pill" aria-label="Downvote">
                                    <i class="bi bi-arrow-down-circle"></i>
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
            <?php endforeach;?>
        </main>
        <?php else:?>
            <h1>PORCO DIO NON CI SONO POST</h1>
        <?php endif;?>
    </div>
</div>