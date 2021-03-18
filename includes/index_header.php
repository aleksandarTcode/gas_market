<?php

require_once ("config.php");
include ("header.php");


print_r($_SESSION);
?>
    <nav class="navbar navbar-expand-sm navbar-dark bg-dark p-0">
        <div class="container">
            <a href="index.php" class="navbar-brand">South Stream</a>
            <button class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <ul class="navbar-nav">

                    <li class="nav-item px-2">
                        <a href="show.php" class="nav-link">Data</a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="insert.php" class="nav-link">Insert</a>
                    </li>
                    <li class="nav-item px-2">
                        <a href="users.php" class="nav-link">Users</a>
                    </li>
                </ul>

                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown mr-3">
                        <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                            <i class="fas fa-user"></i> Welcome <?php echo $_SESSION['username'];?>
                        </a>
                        <div class="dropdown-menu">
                            <a href="profile.html" class="dropdown-item">
                                <i class="fas fa-user-circle"></i> Profile
                            </a>
                            <a href="settings.html" class="dropdown-item">
                                <i class="fas fa-cog"></i> Settings
                            </a>
                        </div>
                    </li>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">
                            <i class="fas fa-user-minus"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- HEADER -->
    <header id="main-header" class="py-2 bg-primary text-white">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h1>
                        <i class="fas fa-cog"></i> Home</h1>
                </div>
            </div>
        </div>
    </header>



