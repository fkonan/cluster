<?php
use Core\FH; 
?>
<?php $this->setSiteTitle('Inicio se sesión'); ?>
<?php $this->start('body');?>
<div class="loginColumns animated fadeInDown">
    <div class="row">
        
        <div class="col-md-6">
            <h2 class="font-bold">Bienvenido al sistema de información  EC2S</h2>

            <p>
                Construcción sostenible y economia circular.
            </p>

            <img alt="logo" class="img-fluid" src="<?=PROOT?>img/logo_ec2s.png">
 
        </div>

        <div class="col-md-6">
            <div class="ibox-content">
                <form class="m-t" role="form" action="" method="post" onsubmit="event.preventDefault(); validarLogin();" id="frmLogin">
                    <?= FH::displayErrors($this->displayErrors)?>
                    <div class="form-group">
                        <?= FH::inputBlock('text','','correo',$this->datos->correo,['class'=>'form-control','placeholder'=>'Correo electróico'],[],$this->displayErrors) ?>
                    </div>
                    <div class="form-group">
                        <?= FH::inputBlock('password','','password',$this->datos->password,['class'=>'form-control','placeholder'=>'Contraseña'],[],$this->displayErrors) ?>
                    </div>
                    <?= FH::submitTag('Iniciar sesión',['class'=>'btn btn-primary block full-width m-b']) ?>

                    <a href="#">
                        Olvido su contraseña?
                    </a>

                    <p class="text-muted text-center mt-3">
                        No tienes cuenta?
                    </p>
                    <a class="btn btn-sm btn-info btn-block" href="<?=PROOT?>users/nuevo">Registrate</a>
                </form>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
          Copyright CLUSTER DE CONSTRUCCIÓN DE SANTANDER.
        </div>

        <div class="col-md-6 text-right">
           <small>© <?=date('Y')?></small>
        </div>
        
    </div>
</div>
<?php $this->end(); ?>
<?php $this->start('footer');?>

<script>
    $(document).ready(function () {
        $("#frmLogin").validate({
            lang: 'es',
            rules: {
                correo: {
                    required: true,
                },
                password:{
                    required:true
                }
            },
            messages: {
               correo: {
                  required:"El correo electrónico es requerido."
               },
               password: {
                  required:"La contraseña es requerida."
               }
           }
        });
    });

    function validarLogin(){

      if($("#frmLogin").valid())
      { 
         var formData = jQuery('#frmLogin').serialize();
         
        jQuery.ajax({
            url : '<?=PROOT?>users/login',
            method: "POST",
            data : formData,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro fue creado correctamente el administrador procedera a revisar la información y le avisará por correo electrónico cuando su usuario se encuentre activo', 'success',2000);
                  if(resp.estado)
                    setTimeout(function () {
                      window.location.href = '<?=PROOT?>home'; //will redirect to your blog page (an ex: blog.html)
                    }, 2000);
                else{
                    setTimeout(function () {
                      window.location.href = '<?=PROOT?>home/inactivo'; //will redirect to your blog page (an ex: blog.html)
                    }, 2000);
                }
               }else{
                  alertMsg('Inicio de sesión fallido!','El usuario o la contraseña no son incorrectos.' ,'error',2000);
                  //jQuery('#frmEmpresa').modal('hide');
               }
            }
         });
      }
   }

</script>
<?php $this->end(); ?>