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
                                        class="form-control <?= error('name') ? 'is-invalid' : '' ?>"
                                        value="<?= old('name') ?>" 
                                    >
                                    <!-- validation message -->
                                    <?php if(error('name')) : ?>
                                        <small class="invalid-feedback"><?= error('name') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email Address</label>
                                    <input 
                                        type="email" 
                                        name="email" 
                                        id="email" 
                                        class="form-control <?= error('email') ? 'is-invalid' : '' ?>" 
                                        value="<?= old('email') ?? '' ?>"
                                    >
                                     <!-- validation message -->
                                    <?php if(error('email')) : ?>
                                        <small class="invalid-feedback"><?= error('email') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="password" class="form-label">Password</label>
                                    <input 
                                        type="password" 
                                        name="password" 
                                        id="password" 
                                        class="form-control <?= error('password') ? 'is-invalid' : '' ?>"
                                    >
                                     <!-- validation message -->
                                    <?php if(error('password')) : ?>
                                        <small class="invalid-feedback"><?= error('password') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="password_confirm" class="form-label">Confirm Password</label>
                                    <input 
                                        type="password" 
                                        name="password_confirmation" 
                                        id="password_confirm" 
                                        class="form-control <?= error('password_confirmation') ? 'is-invalid' : '' ?>"
                                    >
                                    <!-- validation message -->
                                    <?php if(error('password_confirmation')) : ?>
                                        <small class="invalid-feedback"><?= error('password_confirmation') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">Role</label>
                                    <select name="role" id="role" class="form-control <?= error('role') ? 'is-invalid' : '' ?>">
                                        <option value="">Select role</option>
                                        <option 
                                            value="<?= USER ?>" 
                                            <?= 
                                               old('role') == USER ? 'selected' : ''  
                                            ?>
                                        >
                                            User
                                        </option>
                                        <option 
                                            value="<?= ADMIN ?>" 
                                            <?= 
                                                old('role') == ADMIN ? 'selected' : ''  
                                            ?>
                                        >
                                            Admin
                                        </option>
                                        <option 
                                            value="<?= MANAGER ?>" 
                                            <?= 
                                                old('role') == MANAGER ? 'selected' : ''  
                                            ?>
                                        >
                                            Manager
                                        </option>
                                    </select>
                                    <!-- validation message -->
                                    <?php if(error('role')) : ?>
                                        <small class="invalid-feedback"><?= error('role') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Phone</label>
                                    <input 
                                        type="text" 
                                        name="phone" 
                                        id="phone" 
                                        class="form-control <?= error('phone') ? 'is-invalid' : '' ?>"
                                        value="<?= old('phone') ?? '' ?>"
                                    >
                                    <!-- validation message -->
                                    <?php if(error('phone')) : ?>
                                        <small class="invalid-feedback"><?= error('phone') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea 
                                        name="address" 
                                        id="address" 
                                        cols="30" 
                                        rows="4" 
                                        class="form-control <?= error('address') ? 'is-invalid' : '' ?>"
                                    ><?= old('address') ?></textarea>
                                    <!-- validation message -->
                                    <?php if(error('address')) : ?>
                                        <small class="invalid-feedback"><?= error('address') ?></small>
                                    <?php endif ; ?>
                                </div>
                                <button class="btn btn-primary float-end">Create</button>
                            </form>
                        </div>
                    </div>
                </div>
           </div>
        </main>

   <?php require VIEW_PATH . "_partials/footer.php" ?>