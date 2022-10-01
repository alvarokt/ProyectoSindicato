<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-tv"></i>
        </div>
        <div class="sidebar-brand-text mx-3">SISTEMA </div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

        <!-- Nav Item - Dashboard -->
         <li class="nav-item active">
            <a class="nav-link" href="#">
                <i class="fas fa-fw fa-home"></i>
                <span>INICIO</span></a>
         </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
            Interface
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                aria-expanded="true" aria-controls="collapseTwo">
                <i class="fas fa-fw fa-users"></i>
                <span>Socios</span>
            </a>
            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">LISTA:</h6>
                    <a class="collapse-item" href="<?php echo base_url();?>index.php/socio/index">Socios habilitados</a>
                    <a class="collapse-item" href="<?php echo base_url();?>index.php/socio/index">Socios deshabilitados</a>
                    <h6 class="collapse-header">OPCIONES:</h6>
                    <a class="collapse-item" href="<?php echo base_url();?>index.php/socio/agregar">Agregar socio</a>
                </div>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseThree"
                aria-expanded="true" aria-controls="collapseThree">
                <i class="fas fa-fw fa-users"></i>
                <span>Hojas de ruta</span>
            </a>
            <div id="collapseThree" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Opciones:</h6>
                    <a class="collapse-item" href="<?php echo base_url();?>index.php/socio/indexs">Modificar hoja de ruta</a>
                    <a class="collapse-item" href="<?php echo base_url();?>index.php/socio/agregars">Agregar talonario</a>
                </div>
            </div>
        </li>

            <!-- Nav Item - Utilities Collapse Menu -->
           

    <!-- Divider -->
    <hr class="sidebar-divider">

        <!-- Heading -->
        <div class="sidebar-heading">
                
        </div>

        <!-- Nav Item - Pages Collapse Menu -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="<?php echo base_url();?>index.php/socio/venta" >
                <i class="fas fa-fw fa-cash-register"></i>
                <span>Caja</span>
            </a>
        </li>

            <!-- Nav Item - Charts 
            <li class="nav-item">
                <a class="nav-link" href="<?php echo base_url();?>index.php/socio/getdatos">
                    <i class="fas fa-fw fa-dollar-sign"></i>
                    <span>Ventas</span></a>
            </li>-->

            <!-- Reportes -->
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseRep"
                aria-expanded="true" aria-controls="collapseRep">
                <i class="fas fa-fw fa-file"></i>
                <span>Reportes</span>
            </a>
            <div id="collapseRep" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Opciones:</h6>
                    <a class="collapse-item" href="#">Mostrar reportes</a>             
                </div>
            </div>
        </li>

            <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

        <!-- Sidebar Toggler (Sidebar) -->

        <!-- Sidebar Message -->
        <div class="sidebar-card d-none d-lg-flex">
            <img class="sidebar-card-illustration mb-2" src="<?php echo base_url(); ?>sbadmin2/img/undraw_rocket.svg" alt="...">
            <p class="text-center mb-2"><strong>AlvaroRM</strong> desarrollador de este sistema</p>
            <a class="btn btn-success btn-sm" href="#">Contáctame</a>
        </div>

</ul>
<!-- End of Sidebar -->