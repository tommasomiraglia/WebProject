<main>
        <div class="container d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-sm-10 col-md-10 col-lg-10 mx-auto">
                <?php if(isset($templateParams["error"])):?>
                    <h3><?php echo $templateParams["error"]?></h3>
                <?php endif;?>
                <div class="card p-4 shadow-lg rounded-4">

                <?php
                $action_url = "upload.php";
                if ($groupId != -1) {
                    $action_url .= "?groupId=" . $groupId;
                }
                ?>
                <div class="card-body p-0">
                    <form action="<?php echo $action_url;?>" method="POST" enctype="multipart/form-data">

                        <div class="d-flex justify-content-center my-5">
                            <input type="file" id="postImageInput" name="postImage" accept="image/*" class="d-none" />

                            <label for="postImageInput" class="text-center" style="cursor: pointer;">
        
                        <div id="uploadPlaceholder">
                            <i class="bi bi-cloud-arrow-up text-secondary" style="font-size: 8rem;"></i>
                            <p class="text-secondary mt-2">Clicca qui per scegliere un file</p>
                        </div>
        
                        <img id="imagePreview" src="#" alt="Anteprima post"
                        style="max-width: 100%; height: auto; display: none;"
                        class="img-fluid rounded" />
                        </label>
                        </div>

                        <div class="mb-4 px-2">
                            <label for="title" class="form-label text-secondary mb-0">Title:</label>
                            <input type="text" id="title" name="title"
                                class="form-control border-top-0 border-start-0 border-end-0 rounded-0"/>
                        </div>

                        <div class="mb-5 px-2">
                            <label for="description" class="form-label text-secondary mb-0">Description:</label>
                            <textarea id="description" name="description"
                                class="form-control border-top-0 border-start-0 border-end-0 rounded-0"
                                rows="5"></textarea>
                        </div>

                        <div class="d-grid gap-2 px-4 pb-4">
                            <div class="d-flex justify-content-center mb-3">
                                <img src="../assets/icon/form_octi.png" class="logo-upload-size" alt="Form icon" />
                            </div>

                            <button type="submit" class="btn btn-custom-red rounded-pill py-2">Upload</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
