<div class="container py-4">

    <div class="d-flex align-items-center mb-4">
        <i class="bi bi-collection-play fs-1 me-3 text-secondary"></i>
        <h2 class="fw-bold mb-0">Your Communities</h2>
    </div>

    <?php if(empty($templateParams["forums"])): ?>

    <div class="alert alert-light text-center shadow-sm p-5 rounded-4 border-0">
        <div class="mb-3">
            <i class="bi bi-search fs-1 text-secondary"></i>
        </div>
        <h4 class="fw-bold">You don't follow any community yet</h4>
        <p class="text-muted">Explore the available forums and join the discussions!</p>
        <a href="index.php" class="btn btn-dark rounded-pill px-4 mt-2">Explore Forum</a>
    </div>

    <?php else: ?>

    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">

        <?php foreach($templateParams["forums"] as $forum): ?>
        <?php 
                $avatar = !empty($forum['avatar']) ? $forum['avatar'] : 'assets/avatar/avatar0.jpg';
            ?>

        <div class="col">
            <article class="card h-100 border-0 shadow-sm rounded-4">
                <div class="card-body d-flex align-items-center p-3">

                    <div class="flex-shrink-0">
                        <img src="../<?php echo $avatar; ?>" alt="Icona <?php echo htmlspecialchars($forum['name']); ?>"
                            class="rounded-circle border object-fit-cover" width="60" height="60">
                    </div>

                    <div class="flex-grow-1 ms-3 overflow-hidden">
                        <h3 class="card-title h5 fw-bold mb-1 text-truncate">
                            <a href="forum.php?id=<?php echo $forum['groupId']; ?>"
                                class="text-decoration-none text-dark stretched-link">
                                p/<?php echo htmlspecialchars($forum['name']); ?>
                            </a>
                        </h3>

                        <p class="card-text text-muted small text-truncate mb-0">
                            <?php echo htmlspecialchars($forum['longdescription']); ?>
                        </p>
                    </div>

                    <div class="ms-2">
                        <i class="bi bi-chevron-right text-secondary"></i>
                    </div>

                </div>
            </article>
        </div>
        <?php endforeach; ?>

    </div>

    <?php endif; ?>
</div>