<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

            <!-- Sidebar Toggle (Topbar) -->
            <form class="form-inline">
                <button id="sidebarToggleTop" class="btn btn-link rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>

            </form>

            <!-- Topbar Navbar -->
            <ul class="navbar-nav ml-auto">

                <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                <!-- Nav Item - Alerts -->
                <!-- Nav Item - Messages -->


            <div class="topbar-divider d-none d-sm-block"></div>

            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
                <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $this->session->userdata('login'); ?></span>
                    <img class="img-profile rounded-circle"
                        src="<?php echo base_url(); ?>sbadmin2/img/undraw_profile.svg">
                </a>
                <!-- Dropdown - User Information -->
                <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                    aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#">
                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                        Perfil
                </a>
                    
                <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                        Cerrar Sesión
                    </a>
                </div>
            </li>
        </ul>

        </nav>
        <!-- End of Topbar -->
<div class="col-md-12 disabled" > 
<label class="col-md-12 btn disabled border-bottom-warning  bg-gray-200 text-right "> <?php echo date('Y-m-d   H:i'); ?> </label> 
</div>

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="mt-3" >Lista de socios habilitados</h1>

    <br>

    <div class="row">
      <div class="col-md-4 mb-4">
        <div class="form-outline">
            <?php echo form_open_multipart('socio/deshabilitados'); ?>
                <button type="submit" name="buton2" class="btn btn-warning">VER SOCIOS DESHABILITADOS</button>
            <?php echo form_close(); ?>
        </div>
      </div>
      <div class="col-md-3 mb-4">
        <div class="form-outline">
            <?php echo form_open_multipart('socio/agregar'); ?>
                <button type="submit" name="buton1" class="btn btn-primary">AGREGAR SOCIO</button>
            <?php echo form_close(); ?>
        </div>
      </div>
    </div>

                    
