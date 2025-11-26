<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $templateParams["titolo"]; ?></title>

    <link rel="icon" type="image/png" href="/WebProject/website/assets/icon/octopus.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/WebProject/website/css/style.css">
    <script src="/WebProject/website/js/script.js" defer></script>
</head>

<body class="bg-light">
    <div id="sidebar-overlay" class="sidebar-overlay"></div>

    <nav id="sidebar" class="d-flex flex-column">
        <div class="border-bottom p-3">
            <button id="close-btn" class="btn btn-link text-dark text-decoration-none p-0 fs-5">
                <i class="bi bi-x-lg me-2"></i> Close
            </button>
        </div>

        <ul class="list-unstyled px-3 py-2">
            <li class="mb-2">
                <a href="index.php"
                    class="d-flex align-items-center text-decoration-none text-dark py-2 px-3 rounded hover-bg-light">
                    <i class="bi bi-house me-3 fs-5"></i>
                    <span>Home</span>
                </a>
            </li>
            <hr class="my-4">
            <li class="mb-2">
                <a href="#"
                    class="d-flex align-items-center text-decoration-none text-dark py-2 px-3 rounded hover-bg-light">
                    <i class="bi bi-chat-dots me-3 fs-5"></i>
                    <span>Forums</span>
                </a>
            </li>
            <li class="mb-2">
                <a href="#"
                    class="d-flex align-items-center text-decoration-none text-dark py-2 px-3 rounded hover-bg-light">
                    <i class="bi bi-star me-3 fs-5"></i>
                    <span>Favourite Post</span>
                </a>
            </li>
        </ul>
    </nav>

    <nav class="sticky-top bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <i id="menu-btn" class="bi bi-list fs-2 text-dark" role="button"></i>
            <a href="index.php" class="d-flex align-items-center text-decoration-none">
                <img src="/WebProject/website/assets/icon/home_octi.png" width="50" class="rounded-circle mx-2"
                    alt="Octi Home">
            </a>
        </div>
        <div class="input-group w-50">
            <span class="input-group-text bg-white border-end-0 rounded-start-pill">
                <i class="bi bi-search"></i> </span>
            <input type="text" class="form-control border-start-0 rounded-end-pill" placeholder="Value">
        </div>

        <div class="d-flex align-items-center justify-content-end">

            <?php if(isset($_SESSION['userid'])): ?>

            <?php 
        $avatarImg = !empty($_SESSION['avatar']) ? $_SESSION['avatar'] : 'avatar0.jpg'; ?>
            <a href="user.php?userId=<?php echo $_SESSION['userid']?>" class="text-decoration-none me-2">
                <img src="../<?php echo $avatarImg; ?>" class="rounded-circle border" width="45"
                    height="45" alt="My Profile" style="object-fit: cover;">
            </a>

            <?php else: ?>
            <a class="btn btn-dark rounded-pill text-nowrap flex-shrink-0 me-2" href="login.php">Log In</a>

            <?php endif; ?>


            <div class="dropdown">
                <button class="btn btn-link text-dark p-0 flex-shrink-0" type="button" data-bs-toggle="dropdown"
                    aria-expanded="false">
                    <i class="bi bi-three-dots-vertical fs-4"></i>
                </button>

                <ul class="dropdown-menu dropdown-menu-end shadow border-0 p-3" style="min-width: 250px;">

                    <?php if(isset($_SESSION['userid'])): ?>
                    <li>
                        <h6 class="dropdown-header">Hi,
                            <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</h6>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2" href="user.php?userId=<?php echo $_SESSION['userid']?>">
                            <i class="bi bi-person fs-5 me-3"></i>
                            <span>My Profile</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#cookieModal">
                            <i class="bi bi-wrench fs-5 me-3"></i>
                            <span>Cookies Preferences</span>
                        </a>
                    </li>
                    <li>
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2 text-danger fw-bold" href="logout.php">
                            <i class="bi bi-box-arrow-right fs-5 me-3"></i>
                            <span>Exit</span>
                        </a>
                    </li>

                    <?php else: ?>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2" href="login.php">
                            <i class="bi bi-person-plus fs-5 me-3"></i>
                            <span>Login / Sign Up</span>
                        </a>
                    </li>
                    <li>
                        <a class="dropdown-item d-flex align-items-center py-2" href="#" data-bs-toggle="modal"
                            data-bs-target="#cookieModal">
                            <i class="bi bi-wrench fs-5 me-3"></i>
                            <span>Cookies Preferences</span>
                        </a>
                    </li>
                    <?php endif; ?>

                </ul>
            </div>
        </div>
    </nav>

    <div class="container-sm py-3 custom-main-content">
        <?php
            if(isset($templateParams["nome"])){
                require($templateParams["nome"]);
            }
        ?>
    </div>

    <div class="modal fade" id="cookieModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header border-0">
                    <h1 class="modal-title fs-5 fw-bold">Cookie Preferences</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <p class="text-muted small">Manage your tracking preferences.</p>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="fw-bold d-block">Essentials</span>
                            <small class="text-muted">Necessary for operation</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" checked disabled>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <span class="fw-bold d-block">Analytics</span>
                            <small class="text-muted">Usage statistics</small>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" checked>
                        </div>
                    </div>

                </div>

                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-pill" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-dark rounded-pill w-50" data-bs-dismiss="modal">Save
                        Preferences</button>
                </div>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>