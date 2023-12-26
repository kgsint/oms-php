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
                    <h2 class="h4 text-white">Add new Product</h2>

                    <div class="card mb-3">
                        <div class="card-body mx-lg-5" style="overflow:auto;">
                            <form action="/products" method="POST">
                                <!-- title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Product Title</label>
                                    <input 
                                        type="text" 
                                        name="title" 
                                        id="title" 
                                        class="form-control <?= error('title') ? 'is-invalid' : '' ?>"
                                        value="<?= old('title') ?>" 
                                    >
                                    <!-- validation message -->
                                    <?php if(error('title')) : ?>
                                        <small class="invalid-feedback"><?= error('title') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <!-- description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Product Description</label>
                                    <textarea 
                                        name="description" 
                                        id="title" 
                                        class="form-control <?= error('description') ? 'is-invalid' : '' ?>"
                                    ><?= old('description') ?></textarea>
                                    <!-- validation message -->
                                    <?php if(error('description')) : ?>
                                        <small class="invalid-feedback"><?= error('description') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <!-- categories -->
                                <div class="mb-3">
                                    <select name="category" class="form-control <?= (bool) error('category') ? 'is-invalid' : '' ?>">
                                        <option value="">Select Category</option>
                                        <?php foreach($categories as $category) :?>
                                            <option 
                                                value="<?= $category->id ?>"
                                                <?= (int) old('category') === $category->id ? 'selected' : '' ?>
                                            >
                                                <?= htmlspecialchars($category->name) ?>
                                            </option>
                                        <?php endforeach ;?>
                                    </select>
                                    <!-- validation message -->
                                    <?php if(error('category')) : ?>
                                        <small class="invalid-feedback"><?= error('category') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <!-- active switch toggler -->
                                <div class="form-check form-switch">
                                    <label class="form-check-label" for="active">Active</label>
                                    <input 
                                        class="form-check-input" 
                                        type="checkbox" 
                                        name="active" 
                                        role="switch" 
                                        id="active" 
                                        style="cursor: pointer;"
                                        <?= (bool) old('active') ? 'checked' : '' ?>
                                    >
                                </div>
                                <button class="btn btn-primary float-end">Add</button>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>