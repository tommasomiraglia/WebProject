<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $templateParams["titolo"]; ?></title>

    <link rel="icon" type="image/png" href="/WebProject/website/assets/icon/octopus.png">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="/WebProject/website/css/style-admin.css">
    <script src="/WebProject/website/js/script.js" defer></script>
</head>

<body>
    <?php 
        $defaultAvatar = "/WebProject/website/assets/icon/octopus.png";
        if (!empty($_SESSION['avatar'])) {
            $adminImg = "../" . $_SESSION['avatar']; 
        } else {
            $adminImg = $defaultAvatar;
        }
    ?>
    <div class="container d-flex justify-content-center align-items-center min-vh-100 py-5">
        <div class="col-12 col-md-6 col-lg-5 col-xl-4">

            <div class="card shadow-lg rounded-4 p-4">
                <div class="card-body">

                    <header class="text-center mb-5">

                        <img src="<?php echo $adminImg; ?>" alt="Admin Avatar" class="img-fluid admin-avatar shadow">

                        <h5 class="text-muted text-uppercase small ls-2 mb-1">PoliHub Dashboard</h5>

                        <h1 class="h3 fw-bold text-dark">Welcome back,
                            <?php echo isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin'; ?></h1>

                    </header>

                    <main>
                        <div class="d-flex flex-column gap-3">

                            <a href="adminReport.php"
                                class="menu-link text-decoration-none text-dark p-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box">
                                        <i class="bi bi-exclamation-triangle menu-icon"></i>
                                    </div>
                                    <span class="fw-semibold">Reported Posts</span>
                                </div>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>

                            <a href="adminForum.php"
                                class="menu-link text-decoration-none text-dark p-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box">
                                        <i class="bi bi-chat-left-text menu-icon"></i>
                                    </div>
                                    <span class="fw-semibold">Manage Forums</span>
                                </div>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>

                            <a href="adminUsers.php"
                                class="menu-link text-decoration-none text-dark p-3 d-flex align-items-center justify-content-between">
                                <div class="d-flex align-items-center">
                                    <div class="icon-box">
                                        <i class="bi bi-people menu-icon"></i>
                                    </div>
                                    <span class="fw-semibold">Manage Users</span>
                                </div>
                                <i class="bi bi-chevron-right text-muted small"></i>
                            </a>

                        </div>
                    </main>
                    <footer class="mt-5 text-center">
                        <a href="logout.php" class="text-secondary text-decoration-none small hover-underline">
                            <i class="bi bi-box-arrow-right me-1"></i> Log out
                        </a>
                    </footer>

                </div>
            </div>

        </div>
    </div>
</body>

</html>