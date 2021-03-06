<!-- Main Header -->
<header class="main-header">

    <!-- Logo -->
    <a href="<?php echo ($_COOKIE['odjel'] == 'Reklamacije')? 'rma.php': 'primke.php'  ?>" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>E</b>urotrade</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>E</b>urotrade</span>
    </a>

    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>
        <!-- Navbar Right Menu -->
        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
                <li class="dropdown user user-menu">
                    <!-- Menu Toggle Button -->
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        <!-- The user image in the navbar-->
                        <span class="glyphicon glyphicon-user"></span>
                        <!-- hidden-xs hides the username on small devices so only the image appears. -->
                        <span class="hidden-xs"><?php echo $_COOKIE['user'] ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- The user image in the menu -->
                        <li class="user-header" style="height:auto">
                            <div class="pull-left">
                                <a href="korisnik.php?id=<?php echo $_COOKIE['id']?>" class="btn btn-default btn-flat">Profil</a>
                            </div>
                            <div class="pull-right">
                                <a href="./login.php?action=logout" class="btn btn-default btn-flat">Odjavi se</a>
                            </div>
                            <div style="clear:both"></div>
                        </li>
                        <!-- Menu Body -->
                        
                        <!-- Menu Footer-->
                        <li class="user-footer" >
                        </li>
                    </ul>
                </li>
                
            </ul>
        </div>
    </nav>
</header>