<?php
use Core\Session; 
?>
<!DOCTYPE html>
<html>
<head>

   <meta charset="utf-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">

   <title><?=$this->siteTitle();?></title>
   
   <link rel="shortcut icon" type="image/x-icon" href="<?=PROOT?>img/icono_ec2s.ico">

   <link href="<?=PROOT?>css/bootstrap.min.css" rel="stylesheet">
   <link href="<?=PROOT?>font-awesome/css/font-awesome.css" rel="stylesheet">

   <link href="<?=PROOT?>css/animate.css" rel="stylesheet">
   <link href="<?=PROOT?>css/style.css" rel="stylesheet">
   <link href="<?=PROOT?>css/custom.css" rel="stylesheet">
   <link href="<?=PROOT?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
   <link href="<?=PROOT?>css/plugins/iCheck/custom.css" rel="stylesheet">
   <link href="<?=PROOT?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">

</head>

<body class="gray-bg">
   <div id="wrapper">
      <div class="container mt-md-5 mt-sm-3 animated fadeInDown">
         <div class="row text-center navy-bg border mb-md-3 mb-sm-2">
            <div class="col-md-12">
               <h3>REGISTRO DE NUEVOS USUARIOS / EMPRESAS</h3>
               <p align="center">Selecione la opción de registro que mas se ajuste a su perfil.</p>
            </div>
         </div>
         <?= Session::displayMsg() ?>
         <?= $this->content('body'); ?>
         <hr>
         <div class="row">
            <div class="col-md-6">
                Copyright CLUSTER DE CONSTRUCCIÓN DE SANTANDER.
            </div>
            <div class="col-md-6 text-right">
               <small>© <?=date('Y');?></small>
            </div>
         </div>
      </div>
   </div>

   <script src="<?=PROOT?>js/jquery-3.1.1.min.js"></script>
   <script src="<?=PROOT?>js/popper.min.js"></script>
   <script src="<?=PROOT?>js/bootstrap.js"></script>
    <!-- Sweet alert -->
   <script src="<?=PROOT?>js/plugins/sweetalert/sweetalert.min.js"></script>
   <script src="<?=PROOT?>js/plugins/validate/jquery.validate.min.js"></script>
   
   <script src="<?=PROOT?>js/alertMsg.js"></script>
   <script src="<?=PROOT?>js/custom.js"></script>
   <script src="<?=PROOT?>js/plugins/iCheck/icheck.min.js"></script>
   <script>
      $(document).ready(function () {
         $('.i-checks').iCheck({
            checkboxClass: 'icheckbox_square-green',
            radioClass: 'iradio_square-green',
         });
      });
   </script>
   <?= $this->content('footer'); ?>

</body>
</html>