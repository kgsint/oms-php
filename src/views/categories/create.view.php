<!-- ့header -->
<?php require VIEW_PATH . "_partials/header.php" ?>
        <!-- side navigation -->
        <?php require VIEW_PATH . "_partials/side_navigation.php" ?>
        <!-- main section -->
        <main class="col-10 bg-secondary">
           <!-- navbar -->
           <?php require VIEW_PATH . '_partials/navbar.php'; ?>

           <div class="container-fluid p-4">
                <div class="">
                    <h2 class="h4 text-white">Add new Category</h2>

                    <div class="card mb-3">
                        <div class="card-body mx-lg-5" style="overflow:auto;">
                            <form action="/users" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Category Name</label>
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        class="form-control <?= error('name') ? 'is-invalid' : '' ?>"
                                        value="<?= old('name') ?>" 
                                    >
                                    <!-- validation message -->
                                    <?php if(error('name')) : ?>
                                        <small class="invalid-feedback"><?= error('name') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="active">Active</label>
                                    <input class="form-check-input" type="checkbox" name="active" role="switch" id="active" style="cursor: pointer;">
                                </div>
                                <button class="btn btn-primary float-end">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>