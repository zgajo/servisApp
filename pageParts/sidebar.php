<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel" style="min-height: 5em;">
            <div class="pull-left image">
                
            </div>
            <div class="pull-left info">
                <p><?php echo $_COOKIE['user'] ?></p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        

            <br>
            <!-- Sidebar Menu -->
            <ul class="sidebar-menu">
                <li class="header">STRANICE</li>
                <!-- Optionally, you can add icons to the links -->
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/servisApp/primke.php" ? "active" : "");?>"><a href="./primke.php"><i class="glyphicon glyphicon-list-alt"></i> <span>Primke</span></a></li>
                <?php if ($_COOKIE['odjel'] == "Servis") { ?><li class="<?php echo ($_SERVER['PHP_SELF'] == "/servisApp/rn.php" ? "active" : "")?>"><a href="./rn.php"><i class="glyphicon glyphicon-share"></i> <span>Radni nalozi</span></a></li><?php } ?>
                <li class="<?php echo ($_SERVER['PHP_SELF'] == "/servisApp/rma.php" ? "active" : "");?>"><a href="rma.php"><i class="glyphicon glyphicon-random"></i> <span>RMA nalozi</span></a></li>
                
            </ul><!-- /.sidebar-menu -->
            <ul class="sidebar-menu">
           <li class="header">PRETRAGA</li> 
            </ul>
            <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group" id="sk">
                <input type="text" name="q" class="form-control" id="search_kupca" placeholder="Pretraži kupca...">
                <span class="input-group-btn">
                    <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
            </div>
            <div id="search_result_kupac">

             </div>
        </form>
        
            
    </section>
    <!-- /.sidebar -->
</aside>