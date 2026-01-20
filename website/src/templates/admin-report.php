<div class="container-sm py-3 custom-main-content">
    <main class="posts-feed">
        <?php if(isset($templateParams["error"])):?>
        <div class="alert alert-danger" role="alert">
            <?php echo $templateParams["error"]?>
        </div>
        <?php else:?>

        <?php foreach($templateParams["posts"] as $post):?>
        <?php 
            $postImg = $post["postImage"];
            
            $avatar = $post["avatar"];
            if (empty($avatar)) {
                $avatar = '../assets/avatar/avatar0.jpg';
            }
            $dateObj = new DateTime($post["postDate"]);
            $formattedDate = $dateObj->format('d/m/Y');
        ?>

        <article class="card rounded-4 border shadow-sm mb-3" id="post-<?php echo $post['postId']; ?>">
            <div class="card-body">

                <header class="d-flex align-items-center mb-2">
                    <img src="../<?php echo $avatar;?>" class="rounded-circle me-2 group-avatar" alt="group avatar">
                    <div>
                        <h6 class="mb-0 fw-bold">
                            <a class="text-decoration-none text-dark">
                                p/<?php echo htmlspecialchars($post["name"]);?>
                            </a>
                        </h6>
                        <time datetime="<?php echo $post["postDate"];?>" class="text-muted small">
                            <?php echo $formattedDate;?>
                        </time>
                    </div>
                </header>

                <h5 class="card-title fw-bold"><?php echo htmlspecialchars($post["title"]);?></h5>

                <?php if(!empty($postImg)): ?>
                <figure class="mb-3">
                    <img src="../<?php echo $postImg;?>" class="img-fluid rounded-3 w-100" alt="Immage releted to: <?php echo htmlspecialchars($post['title']); ?>">
                </figure>
                <?php endif; ?>

                <p class="card-text">
                    <?php echo htmlspecialchars($post["longdescription"]);?>
                </p>

                <footer class="d-flex justify-content-between align-items-center mt-3 pt-2 border-top">

                    <div class="text-danger fw-bold d-flex align-items-center">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <span>Reports: <?php echo $post["reportCount"];?></span>
                    </div>

                    <div class="dropdown dropup">
                        <button class="btn btn-light btn-sm rounded-circle" type="button" data-bs-toggle="dropdown"
                          aria-expanded="false" aria-label="Admin options">
                            <i class="bi bi-three-dots fs-5"></i>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                            <li>
                                <a class="dropdown-item" href="#"
                                    onclick="inviaAzione('dismiss', <?php echo $post['postId']; ?>)">
                                    <i class="bi bi-check-circle me-2"></i> Dismiss Report
                                </a>
                            </li>

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item text-danger" href="#"
                                    onclick="inviaAzione('delete', <?php echo $post['postId']; ?>)">
                                    <i class="bi bi-trash me-2"></i> Delete Post
                                </a>
                            </li>
                        </ul>
                    </div>
                </footer>

            </div>
        </article>
        <?php endforeach;?>
        <?php endif;?>
    </main>
</div>
