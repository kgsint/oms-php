<nav class="col-2 bg-light pe-3">
     <h1 class="h4 py-3 text-center text-primary">
        <i class="fas fa-ghost me-2"></i>
        <span class="d-none d-lg-inline">
            Ghost Admin
        </span>
     </h1>
     <div class="list-group text-center text-lg-start">
        <!-- <span class="list-group-item disable d-none d-lg-block">
            <small>CONTROLS</small>
        </span> -->
        <a href="/" class="list-group-item list-group-item-action <?= isActiveNav('/') ?>">
            <i class="fas fa-home"></i>
            <span class="d-none d-lg-inline">Dashboard</span>
        </a>
        <a href="/users" class="list-group-item list-group-action <?= isActiveNav('/users') ?>">
            <i class="fas fa-users"></i>
            <span class="d-none d-lg-inline">Users</span>
        </a>
        <a href="/categories" class="list-group-item list-group-action <?= isActiveNav('/categories') ?>">
            <i class="fa-solid fa-layer-group"></i>
            <span class="d-none d-lg-inline">Categories</span>
        </a>    
        <a href="/orders" class="list-group-item list-group-action <?= isActiveNav('/orders') ?>">
            <i class="fas fa-chart-line"></i>
            <span class="d-none d-lg-inline">Orders</span>
        </a>
        <a href="/products" class="list-group-item list-group-action <?= isActiveNav('/products') ?>">
            <i class="fa-solid fa-box"></i>
            <span class="d-none d-lg-inline">Products</span>
        </a>
     </div>

     <div class="list-group mt-5 text-center text-lg-start">
        <span class="list-group-item disabled d-none d-lg-block">
          <small>ACTIONS</small>
        </span>
        <a href="/users/new" class="list-group-item list-group-action <?= isActiveNav('/users/new') ?>">
            <i class="fas fa-user"></i>
            <span class="d-none d-lg-inline">New User</span>
        </a>
        <a href="#" class=" list-group-item list-group-action">
            <i class="fa-solid fa-boxes-stacked"></i>
            <span class="d-none d-lg-inline">New Product</span>
        </a>
        <a href="/categories/new" class=" list-group-item list-group-action <?= isActiveNav('/categories/new') ?>">
            <i class="fa-solid fa-square-plus"></i>
            <span class="d-none d-lg-inline">New Category</span>
        </a>
     </div>
</nav>

