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

                    <div class="card mb-3" style="height:280px;">
                        <div class="card-body" style="overflow:auto;">
                        <?php if(count([[1, 2]])) :?>
                        <div class="text-end mb-2" style="max-width: 400px;">
                            <!-- search -->
                            <form>
                                <div class="input-group">
                                    <input name="s" type="text" class="form-control" placeholder="Search Categories..." />
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
                                    <tr>
                                        <td>1</td>
                                        <td>Category One</td>
                                        <td>category-one</td>
                                        <td>Yes</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <a href="" class="btn btn-link">Update</a>
                                                <form method="POST" action="/users">
                                                        <input type="hidden" name="_method" value="DELETE" >
                                                        <input type="hidden" value="" name="id" >
                                                        <button class="btn btn-link link-danger">Delete</button>
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
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