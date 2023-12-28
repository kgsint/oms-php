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
                    <h2 class="h4 text-white">Edit Product</h2>

                    <a href="/products" class="btn btn-link">Back</a>
                    <div class="card mb-3">
                        <div class="card-body mx-lg-5" style="overflow:auto;">
                            <form action="/products" method="POST">
                                <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="id" value="<?= $product->id ?>">
                                <!-- title -->
                                <div class="mb-3">
                                    <label for="title" class="form-label">Product Title</label>
                                    <input 
                                        type="text" 
                                        name="title" 
                                        id="title" 
                                        class="form-control <?= error('title') ? 'is-invalid' : '' ?>"
                                        value="<?= old('title', $product->title) ?>" 
                                    >
                                    <!-- validation message -->
                                    <?php if(error('title')) : ?>
                                        <small class="invalid-feedback"><?= error('title', $product->title) ?></small>
                                    <?php endif ; ?>
                                </div>
                                <!-- description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Product Description</label>
                                    <textarea 
                                        name="description" 
                                        id="title" 
                                        class="form-control <?= error('description') ? 'is-invalid' : '' ?>"
                                    ><?= old('description', $product->description) ?></textarea>
                                    <!-- validation message -->
                                    <?php if(error('description')) : ?>
                                        <small class="invalid-feedback"><?= error('description') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <!-- price -->
                                <div class="mb-3">
                                    <label for="price" class="form-label">Price</label>
                                    <input 
                                        type="number" 
                                        name="price" 
                                        id="price" 
                                        class="form-control <?= error('price') ? 'is-invalid' : '' ?>"
                                        value="<?= old('price', $product->price) ?>" 
                                        autocomplete="off"
                                    >
                                    <!-- validation message -->
                                    <?php if(error('price')) : ?>
                                        <small class="invalid-feedback"><?= error('price') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <!-- categories -->
                                <div class="mb-3">
                                    <label for="" class="form-label">Please select category or categories</label>
                                    <div class="d-flex align-items-center gap-3">
                                        <?php foreach($categories as $index => $category) :?>
                                            <div class="d-flex align-items-center form-check">
                                              <input 
                                                type="checkbox" 
                                                class="form-check-input <?= (bool) error('categories') ? 'is-invalid' : '' ?>" 
                                                value="<?= $category->id ?>" 
                                                id="category-id-<?= $category->id ?>"
                                                style="cursor:pointer;"
                                                name="categories[]"
                                                <?= old('category') && in_array($category->id, old('category'))  ? 'checked' : '' ?>
                                                <?= in_array($category->name, $product->categories) ? 'checked' : '' ?>
                                            >
                                              <label 
                                                class="form-check-label p-2" 
                                                for="category-id-<?= $category->id ?>"
                                                style="user-select: none;cursor: pointer;"
                                            >
                                                <?= ucfirst($category->name) ?>
                                              </label>
                                            </div>
                                        <?php endforeach; ?>
                                    </div>
                                    <!-- validation message -->
                                    <?php if(error('categories')) : ?>
                                        <small class="text-danger"><?= error('categories') ?></small>
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
                                        <?= (bool) old('active', $product->active) ? 'checked' : '' ?>
                                    >
                                </div>
                                <button class="btn btn-primary float-end">Edit</button>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>
