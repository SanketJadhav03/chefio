<!-- Main Sidebar Container -->
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 pl-3">
            <a href="<?= $base_url ?>" class="d-block">
                Welcome, Admin
            </a>
        </div>
        <!-- Sidebar Menu -->
        <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    <!-- Dashboard -->
    <li class="nav-item">
        <a href="<?= $base_url ?>index.php" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <!-- Customer Management -->
    <li class="nav-item">
        <a href="<?= $base_url ?>customer/index.php" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Customers</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= $base_url ?>contact/index.php" class="nav-link">
            <i class="nav-icon fas fa-address-book"></i>
            <p>Contact</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= $base_url ?>cuisines/index.php" class="nav-link">
            <i class="nav-icon fas fa-utensils"></i>
            <p>Cuisines</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= $base_url ?>mealtype/index.php" class="nav-link">
            <i class="nav-icon fas fa-concierge-bell"></i>
            <p>Meal Type</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= $base_url ?>cookingdifficulty/index.php" class="nav-link">
            <i class="nav-icon fas fa-fire"></i>
            <p>Cooking Difficulty</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= $base_url ?>servingcount/index.php" class="nav-link">
            <i class="nav-icon fas fa-users-cog"></i>
            <p>Serving Count</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= $base_url ?>desiredproduct/index.php" class="nav-link">
            <i class="nav-icon fas fa-heart"></i>
            <p>Desired Products</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= $base_url ?>unwantedproduct/index.php" class="nav-link">
            <i class="nav-icon fas fa-trash"></i>
            <p>Unwanted Products</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= $base_url ?>preparetime/index.php" class="nav-link">
            <i class="nav-icon fas fa-clock"></i>
            <p>Prepare Time</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="<?= $base_url ?>genrate/index.php" class="nav-link">
            <i class="nav-icon fas fa-clock"></i>
            <p>Genrate Racipes</p>
        </a>
    </li>
    <!-- Logout -->
    <li class="nav-item">
        <a href="<?= $base_url ?>logout.php" class="nav-link">
            <i class="nav-icon fas fa-sign-out-alt"></i>
            <p>Logout</p>
        </a>
    </li>
</ul>

        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>