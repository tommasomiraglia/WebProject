<body class="bg-light">
    <div class="container-sm py-3 custom-main-content">
        <main class="posts-feed">
            <?php if(isset($templateParams["error"])):?>
            <h3><?php echo $templateParams["errore"];?></h3>
            <?php else:?>
            <ul class="list-unstyled">
                <?php foreach($templateParams["forums"] as $forum):?>
                <li class="card rounded-4 border shadow-sm my-3" id="forum-row-<?php echo $forum['groupId']; ?>">

                    <div class="card-body d-flex justify-content-between align-items-center">
                        <a href="forum.php?id=<?php echo $forum["groupId"]?>"
                            class="d-flex align-items-center text-decoration-none text-dark">
                            <img src="../<?php echo $forum["avatar"]?>" alt=""
                                class="rounded-circle me-2 object-fit-cover group-avatar"/>
                             <span class="fw-bold">p/<?php echo $forum["name"]?></span>
                        </a>
                        <div class="dropdown">
                            <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-label="Admin options">
                                <i class="bi bi-three-dots fs-5"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li>
                                    <a class="dropdown-item text-danger" href="#"
                                        onclick="deleteForum(<?php echo $forum['groupId']; ?>); return false;">
                                        <i class="bi bi-trash me-2"></i> Delete Forum
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </li>
                <?php endforeach;?>
            </ul>
            <?php endif;?>
        </main>
    </div>
</body>