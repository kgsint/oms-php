<!-- ့header -->
<?php require VIEW_PATH . "_partials/header.php" ?>
        <!-- side navigation -->
        <?php require VIEW_PATH . "_partials/side_navigation.php" ?>
        <!-- main section -->
        <main class="col-10 bg-secondary">
           <!-- navbar -->
           <?php require VIEW_PATH . '_partials/navbar.php'; ?>

           <div class="container-fluid mt-3 p-4">
                <div class="">
                    <h2 class="h4 text-white">Products</h2>

                    <div class="card mb-3">
                        <div class="card-body" style="overflow:auto;">
                            <div class="text-end mb-2" style="max-width: 400px;">
                                <!-- search -->
                                <form>
                                    <div class="input-group">
                                        <input 
                                            name="s" type="text" 
                                            class="form-control" 
                                            placeholder="Search Products..." 
                                            autocomplete="off" 
                                            value="<?= isset($_GET['s']) ? htmlspecialchars($_GET['s']) : '' ?>"
                                        />
                                        <button class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></button>
                                    </div>
                                </form>
                            </div>
                            
                            <table class="table">
                                <tr>
                                    <th>#ID</th>
                                    <th>Title</th>
                                    <th>Categories</th>
                                    <th>Active</th>
                                    <th>Actions</th>
                                </tr>
                                
                            <?php if(count($products)) :?>
                                <!-- loop -->
                                <?php foreach($products as $product) :?>
                                    <tr>
                                        <td><?= $product->id ?></td>
                                        <td>
                                            <h6><?= htmlspecialchars($product->title) ?></h6>
                                            <p class="text-muted" style="font-size:14px"><?= htmlspecialchars($product->description) ?></p>
                                            <p class="fw-bold text-muted" style="font-size: 13px;"><?= htmlspecialchars($product->price) ?>MMK</p>
                                        </td>
                                        <td>
                                            <?php foreach(explode(",", $product->categories)  as $category) :?>
                                                <span class="bg-primary text-white px-2 py-1 rounded-5" style="font-size: 12px;"><?= $category ?></span>
                                            <?php endforeach ;?>
                                        </td>
                                        <td>
                                            <?= 
                                                $product->active ? 
                                                    '<span class="text-success">Active</span>' : 
                                                    '<span class="text-danger">Inactive</span>' 
                                            ?>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="/products/edit?id=<?= $product->id ?>" class="btn btn-link">Edit</a>
                                                <form method="POST" action="/products">
                                                        <input type="hidden" name="_method" value="DELETE" >
                                                        <input type="hidden" value="<?= $product->id ?>" name="id" >
                                                        <button class="btn btn-link link-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ; ?>
                                <!-- when there is no product record -->
                            <?php else: ?>
                                <tr>
                                    <td colspan="5" class="text-center">No Product found</td>
                                </tr>
                            <?php endif; ?>
                            </table>

                            
                            </div>
                        </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>