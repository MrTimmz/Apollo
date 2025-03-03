<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->

    <div class="sidebar-brand-icon">
        <a class="navbar-brand" href="#page-top"><img src="img/logo-3.svg" width="200px" ; alt="..." /></a>
    </div>


    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="index.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-user"></i>
            <span>Users</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">User Management:</h6>
                <a class="collapse-item" href="users.php">Add Users</a>
                <a class="collapse-item" href="users_overview.php">Overview Users</a>
                <a class="collapse-item" href="users_deleted.php">Deleted Users</a>
                <hr class="sidebar-divider">
                <a class="collapse-item" href="roles.php">Add Roles</a>
                <a class="collapse-item" href="roles_overview.php">Overview Roles</a>
                <a class="collapse-item" href="roles_deleted.php">Deleted Roles</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities" aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-chart"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-graph-up" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0Zm14.817 3.113a.5.5 0 0 1 .07.704l-4.5 5.5a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61 4.15-5.073a.5.5 0 0 1 .704-.07Z" />
                </svg></i>


            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="utilities-color.html">Colors</a>
                <a class="collapse-item" href="utilities-border.html">Borders</a>
                <a class="collapse-item" href="utilities-animation.html">Animations</a>
                <a class="collapse-item" href="utilities-other.html">Other</a>
            </div>
        </div>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Pages:</h6>
                <a class="collapse-item" href="pages.php">Add new page</a>
                <a class="collapse-item" href="pages-overview.php">Overview pages</a>
                <a class="collapse-item" href="pages-deleted.php">Deleted pages</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Manage Subpages:</h6>
                <a class="collapse-item" href="subpage.php">Add New Subpage</a>
                <a class="collapse-item" href="subpage-overview.php">Overview Subpages</a>
                <a class="collapse-item" href="subpage-deleted.php">Deleted Subpages</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="404.html">404 Page</a>
                <a class="collapse-item" href="blank.html">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseNews" aria-expanded="true" aria-controls="collapseNews">
            <i class="fas fa-fw fa-newspaper"></i>
            <span>News</span>
        </a>
        <div id="collapseNews" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage News Articles:</h6>
                <a class="collapse-item" href="news.php">Add news article</a>
                <a class="collapse-item" href="news-overview.php">Overview news article</a>
                <a class="collapse-item" href="news-deleted.php">Deleted news article</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Images -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseImages" aria-expanded="true" aria-controls="collapseImages">
            <i class="fas fa-fw fa-image"></i>
            <span>Images</span>
        </a>
        <div id="collapseImages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Image Categories:</h6>
                <a class="collapse-item" href="imagescategory_overview.php">Image Category</a>
                <a class="collapse-item" href="imagescategory_deleted.php">Deleted Image Categories</a>
                <h6 class="collapse-header">Manage Images:</h6>
                <a class="collapse-item" href="images.php">Images</a>
            </div>
        </div>
    </li>



    <!-- Nav Item - Support -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseSupport" aria-expanded="true" aria-controls="collapseSupport">
            <i class="fas fa-fw fa-envelope"></i>
            <span>Support</span>
        </a>
        <div id="collapseSupport" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Forms:</h6>
                <a class="collapse-item" href="forms-overview.php">Forms overview</a>
                <a class="collapse-item" href="forms-list_overview.php">Form list overview</a>
                <hr class="sidebar-divider">
                <a class="collapse-item" href="images.php">Incoming Mail</a>
                <a class="collapse-item" href="images.php">Closed Tickets</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Invoice -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInvoice" aria-expanded="true" aria-controls="collapseInvoice">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Projects</span>
        </a>
        <div id="collapseInvoice" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Projects:</h6>
                <a class="collapse-item" href="projects.php">Create Projects</a>
                <a class="collapse-item" href="projects-overview.php">Projects overview</a>
                <a class="collapse-item" href="projects-deleted.php">Deleted Projects</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Invoice -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseInvoice" aria-expanded="true" aria-controls="collapseInvoice">
            <i class="fas fa-fw fa-receipt"></i>
            <span>Games</span>
        </a>
        <div id="collapseInvoice" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Manage Game Projects:</h6>
                <a class="collapse-item" href="games.php">Create Game</a>
                <a class="collapse-item" href="games-overview.php">Games overview</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->