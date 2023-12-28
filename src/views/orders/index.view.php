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
                                    <th>#</th>
                                    <th>Product</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                                
                            <?php if(count([1])) :?>
                                <!-- loop -->
                                <?php foreach($orders as $order) :?>
                                    <tr>
                                        <td><?= htmlspecialchars($order->uuid) ?></td>
                                        <td>
                                            <h6><?= htmlspecialchars($order->product) ?></h6>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($order->total) ?>
                                        </td>
                                        <td>
                                            <?= 
                                                match((int)$order->status) {
                                                    STATUS_PENDING => 'Pending',
                                                    STATUS_SHIPPED => 'Shipped',
                                                    STATUS_DELIVERED => 'Delivered',
                                                    STATUS_CANCELLED => 'Cancelled',
                                                    default => 'n/a',
                                                };
                                            ?>
                                        </td>
    
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <form method="POST" action="/orders">
                                                        <input type="hidden" name="_method" value="DELETE" >
                                                        <input type="hidden" value="<?= $order->id ?>" name="id" >
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