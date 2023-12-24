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
                                    <input 
                                        type="text" 
                                        name="name" 
                                        id="name" 
                                        value="<?= old('name') ?>" 
                                        class="form-control"
                                    >
                                    <!-- validation message -->
                                    <small class="text-danger"><?= error('name') ?></small>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        class="form-control" 
                                        value="<?= old('email') ?? '' ?>"
                                    >
                                     <!-- validation message -->
                                    <small class="text-danger"><?= error('email') ?></small>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password" 
                                        class="form-control"
                                    >
                                     <!-- validation message -->
                                    <small class="text-danger"><?= error('password') ?></small>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirm" class="form-label">Confirm Password</label>
                                    <input type="password" name="password_confirmation" id="password_confirm" class="form-control">
                                     <!-- validation message -->
                                    <small class="text-danger"><?= error('password_confirmation') ?></small>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control">
                                        <option value="">Select role</option>
                                        <option 
                                            value="1" 
                                            <?= 
                                               old('role') == 1 ? 'selected' : ''  
                                            ?>
                                        >
                                            User
                                        </option>
                                        <option 
                                            value="2" 
                                            <?= 
                                                old('role') == 2 ? 'selected' : ''  
                                            ?>
                                        >
                                            Admin
                                        </option>
                                        <option 
                                            value="3" 
                                            <?= 
                                                old('role') == 3 ? 'selected' : ''  
                                            ?>
                                        >
                                            Manager
                                        </option>
                                    </select>
                                    <!-- validation message -->
                                    <small class="text-danger"><?= error('role') ?? '' ?></small>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input 
                                        type="text" 
                                        name="phone" 
                                        id="phone" 
                                        class="form-control"
                                        value="<?= old('phone') ?? '' ?>"
                                    >
                                    <!-- validation message -->
                                    <small class="text-danger"><?= error('phone') ?></small>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea 
                                        name="address" 
                                        id="address" 
                                        cols="30" 
                                        rows="4" 
                                        class="form-control"
                                    ><?= old('address') ?></textarea>
                                    <!-- validation message -->
                                    <small class="text-danger"><?= error('address') ?></small>
                                </div>
                                <button class="btn btn-primary float-end">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>