    <main>
        <!--Prima si specifica il tipo di container-->
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <!--Ora si specifica il numero di colonne in base alla dimensione del dispositivo con col-sm/md/lg-->
            <div class="col-12 col-sm- col-md-8 col-lg-8">
                <div class="card p-4 shadow-lg rounded-4">
                <div class="card-body">
                    <?php if(isset($templateParams["error"])):?>
                        <h3><?php echo $templateParams["error"]?></h3>
                    <?php endif;?>
                    <form action="signup.php" method="POST" enctype="multipart/form-data">

                        <div class="d-flex justify-content-center my-5">
    
                        <input type="file" id="imageInput" name="profileImage" accept="image/*" class="d-none" />

                        <label for="imageInput" class="text-center" style="cursor: pointer;">
        
                        <div class="rounded-circle overflow-hidden d-flex justify-content-center align-items-center"
                        style="width: 150px; height: 150px; border: 2px dashed #6c757d; background-color: #f8f9fa; position: relative;">
            
                        <div id="uploadPlaceholder" class="text-secondary text-center">
                            <i class="bi bi-person-circle" style="font-size: 4rem;"></i> <p class="small mb-0 mt-1">Scegli immagine</p>
                        </div>

                        <img id="imagePreview" src="#" alt="Anteprima profilo"
                        style="display: none;"
                        class="w-100 h-100 object-fit-cover position-absolute top-0 start-0" />
                        </div>
                        </label>
                        </div>

                        <div class="mb-3">
                            <label for="username" class="form-label">Username</label>
                            <input id="username" type="text" class="form-control" name="username"/>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input id="email" type="email" class="form-control" name="email"/>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input id="password" type="password" class="form-control" name="password"/>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Select Gender</label>
                            <select name="gender" id="gender" class="form-select">
                                <?php foreach($templateParams["gender"] as $gender):?>
                                <option value="<?php echo $gender["gender"]?>"><?php echo $gender["gender"]?></option>
                                <?php endforeach;?>
                            </select>
                        </div>
                        <div class="mb-5 px-2">
                            <label for="description" class="form-label text-secondary mb-0">Description:</label>
                            <textarea id="description" name="description"
                                class="form-control border-top-0 border-start-0 border-end-0 rounded-0"
                                rows="5"></textarea>
                        </div>
                        <div class="mb-2">
                            <button type="submit" class="btn btn-custom-red mb-3 w-100">Submit</button>
                        </div>
                    </form>
                    <p>Already a PoliHubber? <a href="login.php" class="card-link text-muted text-decoration-underscore">Log in</a></p>
                </div>
                </div>
                <div class="mt-3">
                    <img src="../assets/icon/form_octi.png"
                         class="img-fluid d-block mx-auto logo-form-size"
                         alt="Form icon"/>
                </div>
            </div>
        </div>
    </main>