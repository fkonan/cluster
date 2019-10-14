<?php $this->setSiteTitle('Oferta y Demanda')?>
<?php $this->start('head'); ?>
<link href="<?=PROOT?>css/plugins/slick/slick.css" rel="stylesheet">
<link href="<?=PROOT?>css/plugins/slick/slick-theme.css" rel="stylesheet">
<?php $this->end(); ?>
<?php $this->start('body'); ?>
<div class="card border-info">
   <div class="card-header text-center bg-primary text-white">
      <h3>Modulo de Oferta y Demanda</h3>
   </div>
   <div class="card-body pt-2">
         <div class="col-lg-12">
            <div class="slider">
               <div>
                  <div class="ibox-content">
                     <img class="img-fluid" src="<?=PROOT?>img/modulos/oferta y demanda/1.jpg" alt="1">
                  </div>
               </div>
               <div>
                  <div class="ibox-content">
                     <img class="img-fluid" src="<?=PROOT?>img/modulos/oferta y demanda/2.jpg" alt="2">
                  </div>
               </div>
               <div>
                  <div class="ibox-content">
                     <img class="img-fluid" src="<?=PROOT?>img/modulos/oferta y demanda/3.jpg" alt="3">
                  </div>
               </div>
               <div>
                  <div class="ibox-content">
                     <img class="img-fluid" src="<?=PROOT?>img/modulos/oferta y demanda/4.jpg" alt="4">
                  </div>
               </div>
               <div>
                  <div class="ibox-content">
                     <img class="img-fluid" src="<?=PROOT?>img/modulos/oferta y demanda/5.jpg" alt="5">
                  </div>
               </div>
               <div>
                  <div class="ibox-content">
                     <img class="img-fluid" src="<?=PROOT?>img/modulos/oferta y demanda/6.jpg" alt="6">
                  </div>
               </div>
               <div>
                  <div class="ibox-content">
                     <img class="img-fluid" src="<?=PROOT?>img/modulos/oferta y demanda/7.jpg" alt="7">
                  </div>
               </div>
               <div>
                  <div class="ibox-content">
                     <img class="img-fluid" src="<?=PROOT?>img/modulos/oferta y demanda/8.jpg" alt="8">
                  </div>
               </div>
               <div>
                  <div class="ibox-content">
                     <img class="img-fluid" src="<?=PROOT?>img/modulos/oferta y demanda/9.jpg" alt="9">
                  </div>
               </div>
            </div>
         </div>
   </div>
</div>
<?php $this->end(); ?>
<?php $this->start('footer'); ?>
<script src="<?=PROOT?>js/plugins/slick/slick.min.js"></script>
<script>
   $(document).ready(function(){
      $('.slider').slick({
         infinite: true,
         slidesToShow: 3,
         slidesToScroll: 3,
         centerMode: true,
         centerPadding: '50px',
         adaptiveHeight: true,
         variableWidth: true,
         dots: true,
         cssEase: 'linear',


         responsive: [
            {
               breakpoint: 1024,
               settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2,
                  infinite: true,
                  dots: true
               }
            },
            {
               breakpoint: 600,
               settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
               }
            },
            {
               breakpoint: 480,
               settings: {
                  slidesToShow: 2,
                  slidesToScroll: 2
               }
            }
         ]
      });
   });
</script>
<?php $this->end(); ?>
