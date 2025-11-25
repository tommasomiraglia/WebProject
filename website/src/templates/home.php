<aside class="stories-sidebar mb-4">
    <div class="stories-wrapper d-flex overflow-auto">
        <div class="d-flex gap-2 w-100">

            <?php if(isset($templateParams["storie"]) && count($templateParams["storie"]) > 0): ?>
            <?php foreach($templateParams["storie"] as $storia): ?>
            <?php 
                $postImageFromDb = $storia['postImage'];
                if (!empty($postImageFromDb)) {
                    $bgImage = '../' . $postImageFromDb;
                } else {
                    $bgImage = 'https://picsum.photos/200/300';
                }
                $avatarFromDb = $storia['avatar'];
                if (!empty($avatarFromDb)) {
                    $groupAvatar = '../' . $avatarFromDb;
                } else {
                    $groupAvatar = 'https://picsum.photos/50';
                }
                $titolo = $storia['title'];
                if(strlen($titolo) > 20) { 
                    $titolo = substr($titolo, 0, 20) . '...'; 
                }
            ?>

            <div class="card story-card rounded-4 text-white border-0 flex-grow-1"
                style="background-image: url('<?php echo $bgImage; ?>'); height: 200px; background-size: cover; background-position: center; position: relative;">

                <div style="position: absolute; top:0; left:0; right:0; bottom:0; background: linear-gradient(to top, rgba(0,0,0,0.8), transparent); border-radius: inherit;">
                </div>

                <div class="card-body d-flex align-items-end" style="position: relative; z-index: 2;">
                    <header class="d-flex align-items-center" style="position: absolute; bottom: 15px; left: 15px;">
                        
                        <img src="<?php echo $groupAvatar; ?>" class="rounded-circle me-2" width="30" height="30"
                            alt="Avatar">
                        
                        <div>
                            <h6 class="mb-0 fw-bold">
                                <a href="#" class="text-decoration-none text-white">
                                    p/<?php echo htmlspecialchars($storia['name']); ?>
                                </a>
                            </h6>
                            <small class="text-white-60"><?php echo htmlspecialchars($titolo); ?></small>
                        </div>
                    </header>
                </div>
            </div>
            <?php endforeach; ?>
            <?php endif; ?>

        </div>
    </div>
</aside>
<!-- Contenuto principale: il feed dei post -->
<main class="posts-feed">
    <article class="card rounded-4 border shadow-sm mb-3">
        <div class="card-body">
            <header class="d-flex align-items-center mb-2">
                <img src="https://picsum.photos/50" class="rounded-circle me-2" width="40" height="40" alt="Avatar">
                <div>
                    <h6 class="mb-0 fw-bold">
                        <a href="#" class="text-decoration-none text-dark">
                            p/Computer Science
                        </a>
                    </h6>
                    <time datetime="2025-10-24" class="text-muted small">24/10/2025</time>
                </div>
            </header>

            <h5 class="card-title fw-bold">Looking for web developer!</h5>

            <figure class="mb-3">
                <img src="https://picsum.photos/600/300" class="img-fluid rounded-3 w-100" alt="Coding laptop">
            </figure>

            <p class="card-text">We're looking for a passionate fresher to join...</p>

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

    <article class="card rounded-4 border shadow-sm mb-3">
        <div class="card-body">
            <header class="d-flex align-items-center mb-2">
                <img src="https://picsum.photos/51" class="rounded-circle me-2" width="40" height="40" alt="Avatar">
                <div>
                    <h6 class="mb-0 fw-bold">
                        <a href="#" class="text-decoration-none text-dark">
                            p/Architecture
                        </a>
                    </h6>
                    <time datetime="2025-10-24" class="text-muted small">24/10/2025</time>
                </div>
            </header>

            <h5 class="card-title fw-bold">Hello World! first post :/</h5>

            <p class="card-text">Hiii</p>

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
</main>