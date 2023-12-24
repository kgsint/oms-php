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
                    <h2 class="h4 text-white">Create new User</h2>

                    <div class="card mb-3">
                        <div class="card-body mx-lg-5" style="overflow:auto;">
                            <form action="/users" method="POST">
                                <div class="mb-3">
                                    <label for="name" class="form-label">User's name</label>
                                    <input type="text" name="name" id="name" class="form-control">
                                    <!-- validation message -->
                                    <?php if(isset($_SESSION['_errors']['name'])) :?>
                                        <small class="text-danger"><?= $_SESSION['_errors']['name'] ?? '' ?></small>
                                    <?php endif ;?>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input type="email" name="email" id="email" class="form-control">
                                     <!-- validation message -->
                                     <?php if(isset($_SESSION['_errors']['email'])) :?>
                                        <small class="text-danger"><?= $_SESSION['_errors']['email'] ?? '' ?></small>
                                    <?php endif ;?>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control">
                                     <!-- validation message -->
                                     <?php if(isset($_SESSION['_errors']['password'])) :?>
                                        <small class="text-danger"><?= $_SESSION['_errors']['password'] ?? '' ?></small>
                                    <?php endif ;?>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirm" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirm" class="form-control">
                                     <!-- validation message -->
                                     <?php if(isset($_SESSION['_errors']['password_confirmation'])) :?>
                                        <small class="text-danger"><?= $_SESSION['_errors']['password_confirmation'] ?? '' ?></small>
                                    <?php endif ;?>
                                </div>
                                <div class="mb-3">
                                    <label for="role_id" class="form-label">Address</label>
                                    <select name="role_id" id="role_id" class="form-control">
                                        <option value="">Select role</option>
                                        <option value="1">User</option>
                                        <option value="2">Admin</option>
                                        <option value="3">Manager</option>
                                    </select>
                                    <!-- validation message -->
                                    <?php if(isset($_SESSION['_errors']['role_id'])) :?>
                                        <small class="text-danger"><?= $_SESSION['_errors']['role_id'] ?? '' ?></small>
                                    <?php endif ;?>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input type="text" name="phone" id="phone" class="form-control">
                                    <!-- validation message -->
                                    <?php if(isset($_SESSION['_errors']['phone'])) :?>
                                        <small class="text-danger"><?= $_SESSION['_errors']['phone'] ?? '' ?></small>
                                    <?php endif ;?>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea name="address" id="address" cols="30" rows="4" class="form-control"></textarea>
                                    <!-- validation message -->
                                    <?php if(isset($_SESSION['_errors']['address'])) :?>
                                        <small class="text-danger"><?= $_SESSION['_errors']['address'] ?? '' ?></small>
                                    <?php endif ;?>
                                </div>
                                <button class="btn btn-primary float-end">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>