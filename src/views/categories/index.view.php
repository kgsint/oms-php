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
                    <h2 class="h4 text-white">Categories</h2>

                    <div class="card mb-3">
                        <div class="card-body" style="overflow:auto;">
                    <?php if(count($categories)) :?>
                        <div class="text-end mb-2" style="max-width: 400px;">
                            <!-- search -->
                            <form>
                                <div class="input-group">
                                    <input name="s" type="text" class="form-control" placeholder="Search Categories..." autocomplete="off" />
                                    <button class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                          </div>

                          <table class="table">
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Slug</th>
                                <th>Active</th>
                                <th>Actions</th>
                            </tr>

                                <!-- loop -->
                                <?php foreach($categories as $category) :?>
                                    <tr>
                                        <td><?= $category->id ?></td>
                                        <td><?= htmlspecialchars($category->name) ?></td>
                                        <td><?= htmlspecialchars($category->slug) ?></td>
                                        <td>
                                            <?= 
                                                $category->active ? 
                                                    '<span class="text-success">Active</span>' : 
                                                    '<span class="text-danger">Not Active</span>' 
                                            ?>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="/categories/edit?id=<?= $category->id ?>" class="btn btn-link">Edit</a>
                                                <form method="POST" action="/categories">
                                                        <input type="hidden" name="_method" value="DELETE" >
                                                        <input type="hidden" value="<?= $category->id ?>" name="id" >
                                                        <button class="btn btn-link link-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                <?php endforeach ; ?>
                            </table>

                            <!-- when there is no category record -->
                            <?php else: ?>
                                <div class="fw-bold fs-4 text-center">There is no category.</div>
                            <?php endif; ?>
                            </div>
                        </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>