<!doctype html>
<html lang="it">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title><?php echo $templateParams["titolo"]; ?></title>
    <link rel="icon" type="image/png" href="./assets/icon/octopus.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="./css/style.css">
    <script src="../../js/script.js" defer></script>
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
                    <i class="bi bi-house me-3 fs-5"></i><span>Home</span>
                </a>
            </li>
        </ul>
    </nav>

    <nav class="sticky-top bg-white py-2 px-3 border-bottom d-flex align-items-center justify-content-between">
        <div class="d-flex align-items-center">
            <i id="menu-btn" class="bi bi-list fs-2 text-dark" role="button"></i>
            <a href="index.php" class="d-flex align-items-center text-decoration-none">
                <img src="./assets/icon/home_octi.png" width="50" class="rounded-circle mx-2" alt="Octi Home">
            </a>
        </div>
        <div class="input-group w-50">
            <span class="input-group-text bg-white border-end-0 rounded-start-pill"><i class="bi bi-search"></i></span>
            <input type="text" class="form-control border-start-0 rounded-end-pill" placeholder="Cerca...">
        </div>
        <div class="d-flex align-items-center justify-content-end">
            <a class="btn btn-dark rounded-pill text-nowrap flex-shrink-0" href="login.php">Log In</a>
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
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>