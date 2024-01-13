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
                    <h2 class="h4 text-white">Order</h2>

                    <div class="card mb-3">
                        <div class="card-body" style="overflow:auto;">
                            <div class="text-end mb-2" style="max-width: 400px;">
                                <!-- search -->
                                <form>
                                    <div class="input-group">
                                        <input 
                                            name="s" type="text" 
                                            class="form-control" 
                                            placeholder="Search Orders..." 
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
                                    <th>User's name</th>
                                    <th>User's email</th>
                                    <th>Status</th>
                                    <th>Quantity</th>
                                    <th>Actions</th>
                                </tr>
                                
                            <?php if(count($orders)) :?>
                                <!-- loop -->
                                <?php foreach($orders as $order) :?>
                                    <tr>
                                        <td><?= htmlspecialchars($order->uuid) ?></td>
                                        <td>
                                            <h6><?= htmlspecialchars($order->product) ?></h6>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($order->username) ?>
                                        </td>
                                        <td>
                                            <?= htmlspecialchars($order->email) ?>
                                        </td>
                                        <td>
                                            <?= 
                                                \App\Models\Presenter\OrderPresenter::present((int) $order->status)
                                            ?>
                                        </td>
                                        <td class="text-center">
                                            <?= 
                                                htmlspecialchars($order->quantity)
                                            ?>
                                        </td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <!-- update status -->
                                                <form action="/orders" method="POST">
                                                    <input type="hidden" name="_method" value="PATCH">
                                                    <input type="hidden" name="id" value="<?= $order->id ?>">
                                                    <select 
                                                        name="status" 
                                                        onchange="this.form.submit()" 
                                                        class="form-select" 
                                                        style="cursor: pointer;"
                                                    >
                                                        <option 
                                                            value="<?= STATUS_PENDING ?>"
                                                            <?= $order->status == STATUS_PENDING ? 'selected' : '' ?>
                                                        >
                                                            Pending
                                                        </option>
                                                        <option 
                                                            value="<?= STATUS_SHIPPED ?>"
                                                            <?= $order->status == STATUS_SHIPPED ? 'selected' : '' ?>
                                                        >
                                                            Shipped
                                                        </option>
                                                        <option 
                                                            value="<?= STATUS_DELIVERED ?>"
                                                            <?= $order->status == STATUS_DELIVERED ? 'selected' : '' ?>
                                                        >
                                                            Delivered
                                                        </option>
                                                        <option 
                                                            value="<?= STATUS_CANCELLED ?>"
                                                            <?= $order->status == STATUS_CANCELLED ? 'selected' : '' ?>
                                                        >
                                                            Cancelled
                                                        </option>
                                                    </select>
                                                </form>
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
                                    <td colspan="7" class="text-center">No Order yet</td>
                                </tr>
                            <?php endif; ?>
                            </table>  
                        </div>
                    </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>