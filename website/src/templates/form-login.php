<main>
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-8 col-sm-8 col-md-8 col-lg-8 mx-auto">
            <!--Setta le colonne per i vari dispositivi , In ordine : TELEFONO/SMALL , SMALL/TABLET , > 768PX / GRANDI SCHERMI , LAPTOP/SCHERMI -->
            <div class="card p-4 shadow-lg rounded-4">
                <!--ELEMENTO COME CARD = CARD-->
                <div class="card-body">
                    <h2 class="text-center mb-4 card-title fw-bold" style="display:none;">Login</h2>
                    <form action="#" method="POST">
                        <?php if(isset($templateParams["errorelogin"])): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $templateParams["errorelogin"]; ?>
                        </div>
                        <?php endif; ?>
                        <div class="mb-3">
                            <label for="usernameInput" class="form-label text-muted">Username</label>
                            <input type="text" class="form-control form-control-lg" id="usernameInput"
                                placeholder="Value" name="username">
                        </div>

                        <div class="mb-4">
                            <label for="passwordInput" class="form-label text-muted">Password</label>
                            <input type="password" class="form-control form-control-lg" id="passwordInput"
                                placeholder="Value" name="password">
                        </div>

                        <button type="submit" class="btn btn-custom-red w-100 py-3 mb-3 text-uppercase">
                            Sign In
                        </button>
                    </form>
                    <p>Are you a new Polihubber? <a href="signup.php"
                            class="card-link text-muted text-decoration-underscore">Sign Up</a></p>
                </div>
            </div>
            <div class="mt-3">
                <img src="../assets/icon/upload_octi.png" class="img-fluid d-block mx-auto logo-form-size"
                    alt="Form icon" />
            </div>
        </div>
    </div>
</main>