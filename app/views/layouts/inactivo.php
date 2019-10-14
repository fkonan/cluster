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

</head> 
<body class="gray-bg"> 

   <?= $this->content('body'); ?>
   
   <script src="<?=PROOT?>js/jquery-3.1.1.min.js"></script>
   <script src="<?=PROOT?>js/bootstrap.js"></script>
    <!-- Sweet alert -->
   <script src="<?=PROOT?>js/plugins/sweetalert/sweetalert.min.js"></script>
   <script src="<?=PROOT?>js/plugins/validate/jquery.validate.min.js"></script>
   <script src="<?=PROOT?>js/alertMsg.js"></script>
   
   <?= $this->content('footer'); ?>

</body>
</html>