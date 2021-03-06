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
                <br>
                    <?php $localIP = $_SERVER['REMOTE_ADDR'];
                    echo $localIP;?>;
            </div>
        </div>



        <br>
        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">STRANICE</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="<?php echo ($_SERVER['PHP_SELF'] == "/servis/primke.php" ? "active" : ""); ?>"><a href="./primke.php"><i class="glyphicon glyphicon-list-alt"></i> <span>Primke</span></a></li>
            <li class="<?php echo ($_SERVER['PHP_SELF'] == "/servis/rn.php" ? "active" : "") ?>"><a href="./rn.php"><i class="glyphicon glyphicon-share"></i> <span>Radni nalozi</span></a></li>
            <li class="<?php echo ($_SERVER['PHP_SELF'] == "/servis/rma.php" ? "active" : ""); ?>"><a href="rma.php"><i class="glyphicon glyphicon-random"></i> <span>RMA nalozi</span></a></li>
            <?php if ($_COOKIE['odjel'] == "Servis") { ?><li class="<?php echo ($_SERVER['PHP_SELF'] == "/servis/narudzbe.php" ? "active" : "") ?>"><a href="./narudzbe.php"><i class="fa fa-reorder"></i> <span>Narudžbe</span></a></li><?php } ?>


            <li class="treeview">
                <a href="#">
                  <i class="fa  fa-book"></i> 
                  <span>Dokumentacija</span>
                  <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu" style="display: none;">
                    <li><a href="dokumentacija.php"><i class="fa fa-search"></i> Pregled</a></li>
                    <li><a href="dokumentacija.php?stvori=Da"><i class="fa  fa-edit"></i> Stvori novo</a></li>
                </ul>
            </li>





        </ul><!-- /.sidebar-menu -->
        <ul class="sidebar-menu">
            <li class="header">PRETRAGA</li> 
        </ul>
        <!-- search form (Optional) -->
        <div class="sidebar-form" autocomplete="off">
            <div class="input-group" id="sk">
                <input type="text" name="q" class="form-control" id="search_kupca" placeholder="Pretraži kupca..." autocomplete="off">
                <span  id="ikonek"  class="input-group-btn">
                    <span type="submit" name="search" id="search-btn" class="btn btn-flat"><i id="searchk" class="fa fa-search"></i><i id="cancelk" style="display: none" class="fa fa-remove"></i></span>
                </span>
            </div>

        </div>

        <div class="sidebar-form" autocomplete="off">
            <div class="input-group" id="sp">
                <input type="text" name="q" class="form-control" id="search_primka" placeholder="Pretraži po primci..." autocomplete="off">
                <span  id="ikonep"  class="input-group-btn">
                    <span type="submit" name="search" id="search-btn" class="btn btn-flat"><i id="searchp" class="fa fa-search"></i><i id="cancelp" style="display: none" class="fa fa-remove"></i></span>
                </span>
            </div>

        </div>
        
         <div class="sidebar-form" autocomplete="off">
            <div class="input-group" id="ss">
                <input type="text" name="q" class="form-control" id="search_serijski" placeholder="Pretraži po serijskom..." autocomplete="off">
                <span id="ikones" class="input-group-btn">
                    <span type="submit" name="search" id="search-btn" class="btn btn-flat"><i id="searchs" class="fa fa-search"></i><i id="cancels" style="display: none" class="fa fa-remove"></i></span>
                </span>
            </div>

        </div>


    </section>
    <!-- /.sidebar -->
</aside>
