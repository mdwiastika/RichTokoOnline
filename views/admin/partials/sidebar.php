 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
     <div class="sidebar-brand">
         <a href="/admin/dashboard" class="brand-link">
             <img src="./../../assets/logo-2-no-bg.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow rounded-circle">
             <span class="brand-text fw-light"><?= $copyright ?></span>
         </a>
     </div>
     <div class="sidebar-wrapper">
         <nav class="mt-2">
             <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                 <li class="nav-item"> <a href="/admin/dashboard" class="nav-link <?= $title == 'Dashboard' ? 'active' : '' ?>"> <i class="nav-icon bi bi-bar-chart"></i>
                         <p>Dashboard</p>
                     </a>
                 </li>
                 <li class="nav-item <?= $title == 'Manajemen User' ? 'menu-open' : '' ?>"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-people"></i>
                         <p>
                             Manajemen User
                             <i class="nav-arrow bi bi-chevron-right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item"> <a href="/admin/users" class="nav-link <?= $sub_title == 'Manajemen User' ? 'active' : '' ?>"> <i class="nav-icon bi bi-circle"></i>
                                 <p>Data User</p>
                             </a>
                         </li>
                         <li class="nav-item"> <a href="/admin/users/create.php" class="nav-link <?= $sub_title == 'Create User' ? 'active' : '' ?>"> <i class="nav-icon bi bi-circle"></i>
                                 <p>Create User</p>
                             </a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item"> <a href="/auth/logout.php" class="nav-link"> <i class="nav-icon bi bi-door-closed"></i>
                         <p>Logout</p>
                     </a>
                 </li>
             </ul>
         </nav>
     </div>
 </aside>