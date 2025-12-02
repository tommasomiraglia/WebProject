<body class="bg-light">
    <script src="/WebProject/website/js/admin.js" defer></script>
    <div class="container-sm py-3 custom-main-content">
        <main class="posts-feed">
            <?php if(isset($templateParams["errore"])):?>
            <h3><?php echo $templateParams["errore"]?></h3>
            <?php else:?>

            <ul class="list-unstyled">
                <?php foreach($templateParams["users"] as $user):?>

                <?php 
                $avatarPath = !empty($user["avatar"]) ? $user["avatar"] : 'assets/avatar/avatar0.jpg'; 
            ?>

                <li class="card rounded-4 border shadow-sm my-3" id="user-row-<?php echo $user['userId']; ?>">
                    <div class="card-body d-flex justify-content-between align-items-center">

                        <a class="d-flex align-items-center text-decoration-none text-dark">
                            <img src="../<?php echo $avatarPath; ?>" alt="User Avatar"
                                class="rounded-circle me-2 object-fit-cover" width="40" height="40" />
                            <span class="fw-bold">u/<?php echo $user["username"];?></span>
                        </a>

                        <div class="dropdown">
                            <button class="btn btn-link text-dark p-0" type="button" data-bs-toggle="dropdown"
                                aria-expanded="false" aria-label="Admin options">
                                <i class="bi bi-three-dots fs-5"></i>
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end shadow border-0">
                                <li>
                                    <h6 class="dropdown-header">Admin Actions</h6>
                                </li>
                                <li>
                                    <a class="dropdown-item text-danger" href="#"
                                        onclick="deleteUser(<?php echo $user['userId']; ?>); return false;">
                                        <i class="bi bi-trash me-2"></i> Ban User
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
