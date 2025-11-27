<!-- contenitore centrato -->
    <div class="container-sm py-3 custom-main-content">
        <!-- Contenuto principale: il feed dei post -->
        <main class="posts-feed">
            <?php if(isset($templateParams["error"])):?>
                <h3><?php echo $templateParams["error"]?><h3>
            <?php else:?>
            <?php foreach($templateParams["posts"] as $post):?>
            <article class="card rounded-4 border shadow-sm mb-3">
                <div class="card-body">
                    <header class="d-flex align-items-center mb-2">
                        <img src="../<?php $post["avatar"];?>" class="rounded-circle me-2" width="40" height="40"
                            alt="Avatar">
                        <div>
                            <h6 class="mb-0 fw-bold">
                                <a href="forum.php?groupId=<?php echo $post["groupId"]?>" class="text-decoration-none text-dark">
                                    <?php echo $post["name"];?>
                                </a>
                            </h6>
                            <time datetime="2025-10-24" class="text-muted small"><?php echo $post["postDate"];?></time>
                        </div>
                    </header>

                    <h5 class="card-title fw-bold"><?php echo $post["title"];?></h5>

                    <figure class="mb-3">
                        <img src="../<?php echo $post["postImage"];?>" class="img-fluid rounded-3 w-100" alt="Coding laptop">
                    </figure>

                    <p class="card-text"><?php echo $post["longdescription"];?></p>

                    <footer class="d-flex justify-content-between align-items-center mt-3">
                        <div>
                            <a>Report Count : <?php echo $post["reportCount"];?></a>
                        </div>
                        <button class="btn btn-light btn-sm" aria-label="More options">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </footer>
                </div>
            </article>
            <?php endforeach;?>
            <?php endif;?>
        </main>
    </div>
