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
                    <h2 class="h4 text-white">Users</h2>

                    <div class="card mb-3" style="height:280px;">
                        <div class="card-body" style="overflow:auto;">
                        <?php if(count($users)) :?>
                        <div class="text-end">
                            <!-- search -->
                            <form>
                                <div class="input-group">
                                    <input name="s" type="text" class="form-control" placeholder="Search Users..." />
                                    <button class="input-group-text" id="basic-addon1"><i class="fas fa-search"></i></button>
                                </div>
                            </form>
                          </div>

                          <table class="table">
                            <tr>
                                <th>#ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Phone</th>
                                <th>Actions</th>
                            </tr>

                                <!-- loop -->
                                <?php foreach($users as $user) :?>
                                    <tr>
                                        <td><?= htmlspecialchars($user->id) ?></td>
                                        <td><?= htmlspecialchars($user->name) ?></td>
                                        <td><?= htmlspecialchars($user->email) ?></td>
                                        <td><?= htmlspecialchars($user->address) ?></td>
                                        <td><?= htmlspecialchars($user->phone) ?></td>
                                        <td>
                                            <form method="POST" action="/users">
                                                <input type="hidden" name="_method" value="DELETE" >
                                                <input type="hidden" value="<?= htmlspecialchars($user->id) ?>" name="id" >
                                                <button class="btn btn-link link-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                <?php endforeach ; ?>
                            </table>

                            <!-- when there is no user record -->
                            <?php else: ?>
                                <div class="fw-bold fs-4 text-center">There is no user at the moment.</div>
                            <?php endif; ?>
                            </div>
                        </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>