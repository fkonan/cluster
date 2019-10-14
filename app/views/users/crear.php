<?php $this->setSiteTitle('Registro de nuevo usuario')?>
<?php $this->start('body')?>
<div class="row border bg-white text-center">      
   <div class="col-lg-6">
      <div class="ibox">
         <div class="ibox-title mt-3 pr-4">
            <h5>Registro de Empresa</h5>
         </div>
         <div class="ibox-content">
            <button type="button" class="btn btn-outline btn-primary dim" href="#modalEmpresa" data-toggle="modal" data-target="#modalEmpresa" data-backdrop="static" data-keyboard="false">
               <i class="fa fa-building fa-6x my-2"></i>
               <h3 class="font-bold no-margins">
                  Registrar Empresa
               </h3>
               Aqui puedes registrarte como nueva empresa.
            </button>
         </div>
      </div>
   </div>
   <div class="col-lg-6">
      <div class="ibox">
         <div class="ibox-title mt-3 pr-4">
            <h5>Registro de Persona Narutal</h5>
         </div>
         <div class="ibox-content">
            <button type="button" class="btn btn-outline btn-primary dim" href="#modalUsuario" data-toggle="modal" data-target="#modalUsuario" data-backdrop="static" data-keyboard="false">
               <i class="fa fa-users fa-6x my-2"></i>
               <h3 class="font-bold no-margins">
                  Registrar Persona
               </h3>
               Aqui puedes registrarte como nuevo usuario.
            </button>
         </div>
      </div>
   </div>
   <div class="col-md-12 align-items-center pb-5">
      <a href="<?=PROOT?>users/login" class="btn btn-primary col-md-4">VOLVER</a>
   </div>
</div>
<?php $this->partial('users','form_empresa');?>
<?php $this->partial('users','form_usuario');?>
<?php $this->end(); ?>

<?php $this->start('footer');?>
<script>
   $(document).ready(function () {

      jQuery('#modalEmpresa').on('hidden.bs.modal',function(){
         var frmEmpresa = $( "#frmEmpresa" );
         frmEmpresa.validate().resetForm();
         frmEmpresa.find('.error').removeClass('error');
      });

      jQuery('#modalEmpresa').on('show.bs.modal', function(){

         $("#frmEmpresa").validate({
            lang: 'es',
            rules: {
               nit: {
                  required: true,
                  maxlength: 20, 
               },
               razon_social:{
                  required:true
               },
               direccion:{
                  required:true
               },
               representante_legal:{
                  required:true
               },
               nombre_contacto:{
                  required:true
               },
               tipo_empresa_id:{
                  required:true
               },
               tipo_documento:{
                  required:true
               },
               documento:{
                  required:true
               },
               nombre:{
                  required:true
               },
               apellido:{
                  required:true
               },
               correo:{
                  required:true
               },
               password:{
                  required:true
               },
               confirm:{
                  required:true
               }

            },
            messages: {
               nit: {
                  required:"El nit es requerido.",
                  maxlength:"El nit no puede exceder los 20 caracteres."
               },
               razon_social: {
                  required:"La razón social es requerida."
               },
               direccion: {
                  required:"La dirección es requerida."
               },
               representante_legal: {
                  required:"El del representante legal es requerido."
               },
               nombre_contacto: {
                  required:"El nombre de contacto es requerido."
               },
               tipo_empresa_id: {
                  required:"El tipo de empresa es requerida."
               },
               tipo_documento: {
                  required:"El tipo de documento es requerido."
               },
               documento: {
                  required:"El documento es requerido."
               },
               nombre: {
                  required:"El nombre del usuario es requerido."
               },
               apellido: {
                  required:"El apellido del usuario es requerioa."
               },
               correo: {
                  required:"El correo electrónico es requerido."
               },
               password: {
                  required:"La contraseña es requerida."
               },
               confirm: {
                  required:"Confirmar contraseña es requerida."
               }
            }
         });
      });

      jQuery('#modalUsuario').on('hidden.bs.modal',function(){
         var frmUsuario = $( "#frmUsuario" );
         frmUsuario.validate().resetForm();
         frmUsuario.find('.error').removeClass('error');
      });

      jQuery('#modalUsuario').on('show.bs.modal', function(){
         $("#frmUsuario").validate({
            lang: 'es',
            rules: {
               tipo_documento:{
                  required:true
               },
               documento:{
                  required:true
               },
               nombre:{
                  required:true
               },
               apellido:{
                  required:true
               },
               correo:{
                  required:true
               },
               password:{
                  required:true
               },
               confirm:{
                  required:true
               }
            },
            messages: {
               tipo_documento: {
                  required:"El tipo de documento es requerido."
               },
               documento: {
                  required:"El documento es requerido."
               },
               nombre: {
                  required:"El nombre del usuario es requerido."
               },
               apellido: {
                  required:"El apellido del usuario es requerioa."
               },
               correo: {
                  required:"El correo electrónico es requerido."
               },
               password: {
                  required:"La contraseña es requerida."
               },
               confirm: {
                  required:"Confirmar contraseña es requerida."
               },
               empresa_id: {
                  required:"Empresa es requerida."
               }
            }
         });
      });
   });

   $('input').on('ifChecked', function(event){
      document.getElementById("empresa_id_usuario").disabled = false;
      $('#empresa_id_usuario').rules('add',{required:true});
   });

    $('input').on('ifUnchecked', function(event){
      document.getElementById("empresa_id_usuario").disabled = true;
      $('#empresa_id_usuario').rules('add',{required:false});
      $('#empresa_id_usuario').removeClass('error');
   });


   function guardarEmpresa(){
      if($("#frmEmpresa").valid())
      {
         var formData = jQuery('#frmEmpresa').serialize();

         jQuery.ajax({
            url : '<?=PROOT?>users/guardarEmpresa',
            method: "POST",
            data : formData,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro fue creado correctamente el administrador procedera a revisar la información y le avisará por correo electrónico cuando su usuario se encuentre activo', 'success',2000);
                  setTimeout(function () {
                      window.location.href = '<?=PROOT?>users/login'; //will redirect to your blog page (an ex: blog.html)
                  }, 2500);
               }else{
                  alertMsg('Proceso fallido!','Ha ocurrido un error al momento de realizar el registro, contactese con el administrador del sistema.' ,'error',2000);
                  //jQuery('#frmEmpresa').modal('hide');
               }
            }
         });
      }
   }

   function guardarUsuario(){
      if($("#frmUsuario").valid())
      {
         var formData = jQuery('#frmUsuario').serialize();
         jQuery.ajax({
            url : '<?=PROOT?>users/guardarUsuario',
            method: "POST",
            data : formData,
            success: function(resp){
               if(resp.success){
                  alertMsg('Proceso exitoso!','El registro fue creado correctamente el administrador procedera a revisar la información y le avisará por correo electrónico cuando su usuario se encuentre activo', 'info',2500);
                  setTimeout(function () {
                      window.location.href = '<?=PROOT?>users/login'; //will redirect to your blog page (an ex: blog.html)
                   }, 2700);
               }else{
                  alertMsg('Proceso fallido!','Ha ocurrido un error al momento de realizar el registro, contactese con el administrador del sistema.' ,'error',2500);
                  //jQuery('#frmEmpresa').modal('hide');
               }
            }
         });
      }
   }
</script>
<?php $this->end(); ?>
