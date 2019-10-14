<div class="loginColumns animated fadeInDown">
    <div class="row">
        <div class="col-md-6">
            <h2 class="font-bold">Bienvenido al sistema de información  EC2S</h2>
            <img alt="logo" class="img-fluid" src="<?=PROOT?>img/logo_ec2s.png">
            <div class="m-t-md">
                <h3 class="font-bold no-margins text-justify">
                    Su usuario no ha sido activado, por favor espere a que el administrador del sistema se comunique con usted, o llegue la información para la activación de su cuenta al correo registrado.
                </h3>
            </div>
        </div>

        <div class="col-md-6">
            <div class="widget-head-color-box navy-bg p-lg text-center">
                <div class="m-b-md">
                    <h2 class="font-bold no-margins">
                        <?=$this->user->nombre?>
                    </h2>
                    <p>Miembro desde: <?=date('Y-m-d',strtotime($this->user->fecha_registro));?></p>
                </div>
                <img src="<?=PROOT?>img/usuario_inactivo.png" class="rounded-circle circle-border m-b-md img-fluid" alt="perfil">
                <a href="<?=PROOT?>users/logout" class="btn btn-primary col-md-4">VOLVER</a>
            </div>
        </div>
    </div>
    <hr/>
    <div class="row">
        <div class="col-md-6">
            Copyright CLUSTER DE CONSTRUCCION DE SANTANDER.
        </div>

        <div class="col-md-6 text-right">
           <small>© <?=date('Y')?></small>
        </div>
        
    </div>
</div>


