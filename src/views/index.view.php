    <!-- ့header -->
    <?php require VIEW_PATH . "_partials/header.php" ?>
        <!-- side navigation -->
        <?php require VIEW_PATH . "_partials/side_navigation.php" ?>
        <!-- main section -->
        <main class="col-10 bg-secondary">
           <!-- navbar -->
           <?php require VIEW_PATH . '_partials/navbar.php'; ?>

           <div class="container-fluid mt-3 p-4">
              <div class="row flex-column flex-lg-row">
                <h2 class="h6 text-white-50">
                    Stats
                </h2>
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-title">
                                <?= $users_count ?>
                            </h3>
                            <span class=" text-muted">
                                Total Users
                            </span>
                        </div>
                    </div>
                </div>    
                <div class="col">
                        <div class="card mb-3">
                            <div class="card-body">
                                <h3 class="card-title">2,354,353</h3>
                                <span class="text-muted">
                                    Total Orders
                                </span>
                            </div>
                        </div>
                </div>
                <div class="col">
                    <div class="card mb-3">
                        <div class="card-body">
                            <h3 class="card-muted"><?= $products_count ?></h3>
                            <span class="text-muted">
                                Total Products
                            </span>
                        </div>
                    </div>
                </div>
              </div>

              <div class="mt-4">
                <div class="">
                    <h2 class="h6 text-white-50">Latest Orders</h2>

                    <div class="card mb-3" style="height:280px;">
                       <div class="card-body" style="overflow:auto;">
                          <table class="table">
                            <tr>
                                <th>#ID</th>
                                <th>Product</th>
                                <th>Total</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>

                            <tr>
                                <td>#24dfop322</td>
                                <td>Shirt</td>
                                <td>3000</td>
                                <td>Pending</td>
                                <td>
                                    <a class="link">Update Status</a>
                                </td>
                            </tr>
                          </table>
                       </div>
                    </div>
                </div>
              </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>