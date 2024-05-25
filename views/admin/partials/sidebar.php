 <aside class="app-sidebar bg-body-secondary shadow" data-bs-theme="dark">
     <div class="sidebar-brand">
         <a href="./index.html" class="brand-link">
             <img src="./assets/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image opacity-75 shadow">
             <span class="brand-text fw-light"><?= $copyright ?></span>
         </a>
     </div>
     <div class="sidebar-wrapper">
         <nav class="mt-2">
             <ul class="nav sidebar-menu flex-column" data-lte-toggle="treeview" role="menu" data-accordion="false">
                 <li class="nav-item"> <a href="/admin/dashboard" class="nav-link"> <i class="nav-icon bi bi-bar-chart"></i>
                         <p>Dashboard</p>
                     </a> </li>
                 <li class="nav-item"> <a href="#" class="nav-link"> <i class="nav-icon bi bi-box-seam-fill"></i>
                         <p>
                             Widgets
                             <i class="nav-arrow bi bi-chevron-right"></i>
                         </p>
                     </a>
                     <ul class="nav nav-treeview">
                         <li class="nav-item"> <a href="./widgets/small-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                 <p>Small Box</p>
                             </a> </li>
                         <li class="nav-item"> <a href="./widgets/info-box.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                 <p>info Box</p>
                             </a> </li>
                         <li class="nav-item"> <a href="./widgets/cards.html" class="nav-link"> <i class="nav-icon bi bi-circle"></i>
                                 <p>Cards</p>
                             </a> </li>
                     </ul>
                 </li>
             </ul>
         </nav>
     </div>
 </aside>