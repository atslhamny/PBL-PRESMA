<!-- sidebar -->
<div class="sidebar" style="background-color: #1E6892;">
    <!-- Sidebar user (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="img/user.png" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="profile.php" class="d-block">
                <?php echo isset($_SESSION['username']) ? htmlspecialchars($_SESSION['username']) : 'Guest'; ?>
            </a>
        </div>
    </div>

    <!-- SidebarSearch Form -->
    <div class="form-inline" style="padding: 9px;">
        <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar-light" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-light">
                    <i class="fas fa-search fa-fw" style="color: #000;"></i>
                </button>
            </div>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <?php 
    if ($_SESSION['role_id'] == 1) {
        include('pages/admin.php');
    }

    if ($_SESSION['role_id'] == 2) {
        include('pages/user.php');
    }

   
    ?>
</div>