<body class="bg-light">
    <div class="container-sm py-3 custom-main-content">
        <main class="posts-feed">
            <?php if(isset($templateParams["error"])):?>
                <h3><?php echo $templateParams["errore"];?></h3>
            <?php else:?>
            <ul class="list-unstyled">
                 <?php foreach($templateParams["forums"] as $forum):?>
                <li class="card rounded-4 border shadow-sm my-3">
                    <div class="card-body d-flex justify-content-between align-items-center">
                        <a href="forum.php?id=<?php echo $forum["groupId"]?>" class="d-flex align-items-center text-decoration-none text-dark">
                            <img src="../<?php echo $forum["avatar"]?>" alt="" class="rounded-circle me-2 object-fit-cover"
                                width="40" height="40" />
                            <?php echo $forum["name"]?>
                        </a>
                        <button class="btn btn-link text-dark p-0" aria-label="More options">
                            <i class="bi bi-three-dots"></i>
                        </button>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
            <?php endif;?>
        </main>
    </div>
</body>