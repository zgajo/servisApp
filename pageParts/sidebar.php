<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel" style="min-height: 50px;">
            <div class="pull-left image">
                
            </div>
            <div class="pull-left info">
                <p><?php echo $_COOKIE['user'] ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
        </form>
        

        <div class="form-group">
            <br>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">HEADER</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/primke.php" ? "active" : "");?>"><a href="../primke.php"><i class="fa fa-link"></i> <span>Primke</span></a></li>
                <?php if ($_COOKIE['odjel'] == "Servis") { ?><li class="<?php echo ($_SERVER['PHP_SELF'] == "/rn.php" ? "active" : "")?>"><a href="../rn.php"><i class="fa fa-link"></i> <span>Radni nalozi</span></a></li><?php } ?>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/rma.php" ? "active" : "");?>"><a href="../rma.php"><i class="fa fa-link"></i> <span>RMA nalozi</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-link"></i> <span>Multilevel</span> <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="treeview-menu">
                        <li><a href="#">Link in level 2</a></li>
                        <li><a href="#">Link in level 2</a></li>
                    </ul>
                </li>
            </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>