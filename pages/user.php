 <nav class="mt-2">
     <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
         <!-- Dashboard -->
         <li class="nav-item">
             <a href="index.php?page=dashboard" class="nav-link <?= ($page === 'dashboard') ? 'active' : ''; ?>">
                 <i class="nav-icon fas fa-tachometer-alt"></i>
                 <p>Dashboard</p>
             </a>
         </li>

         <!-- Kompetisi Mahasiswa -->
         <li class="nav-item">
             <a href="index.php?page=kompetisi" class="nav-link <?= ($page === 'kompetisi') ? 'active' : ''; ?>">
                 <i class="nav-icon fas fa-bookmark"></i>
                 <p>Kompetisi Mahasiswa</p>
             </a>
         </li>

         <!-- Prestasi Mahasiswa -->
         <li class="nav-item">
             <a href="index.php?page=prestasi" class="nav-link <?= ($page === 'prestasi') ? 'active' : ''; ?>">
                 <i class="nav-icon fas fa-book"></i>
                 <p>Prestasi Mahasiswa</p>
             </a>
         </li>

         <!-- Logout -->
         <li class="nav-item">
             <a href="./logout.php" class="nav-link">
                 <i class="nav-icon fas fa-sign-out-alt"></i>
                 <p>Logout</p>
             </a>

         </li>
     </ul>
 </nav>