

<section class="vh-100" style="background-color: #555670;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col col-xl-10">
        <div class="card" style="border-radius: 1rem;">
          <div class="row g-0">
            <div class="col-md-6 col-lg-5 d-none d-md-block ">
              <img src="<?php echo base_url(); ?>sbadmin2/img/draw2.svg"
                alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;" />
            </div>
            <div class="col-md-6 col-lg-7 d-flex align-items-center">
              <div class="card-body p-4 p-lg-5 text-black">

                <?php
                echo form_open_multipart('usuario/validar',array('id'=>'form1','class'=>'form-control'))
                ?>


                  <div class="d-flex align-items-center mb-3 pb-1">
                    <i class="fas fa-tv" ></i>
                    <span class="h1 fw-bold mb-0">Sistema</span>
                  </div>

                  <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">Ingrese a su cuenta</h5>

                  <div class="form-outline mb-4">
                    <input type="text" name="login" class="form-control" placeholder="Ingrese su nombre de usuario" />
                    <label class="form-label" >Nombre de Usuario</label>
                  </div>

                  <div class="form-outline mb-4">
                    <input type="password" name="password" class="form-control" placeholder="Ingrese su nombre de contraseña" />
                    <label class="form-label" >Contraseña</label>
                  </div>

                  <div class="pt-1 mb-4">
                    <button class="btn btn-dark btn-lg btn-block" type="submit">Ingresar</button>
                  </div>

                  <p class="small text-muted" >¿Olvido su contraseña?</p>
                  <p class="mb-5 pb-lg-2" style="color: #393f81;"> <a href="#!"
                      style="color: #393f81;">Contáctame</a></p>


                <?php
                echo form_close();
                ?>

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>