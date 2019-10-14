<?php
use Core\Session;
use App\Models\Users;
use App\Controllers;
use App\Models\Modulos;
use App\Controllers\PermisosController;
use App\Controllers\RolesController;
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
   <link href="<?=PROOT?>css/plugins/sweetalert/sweetalert.css" rel="stylesheet">
   <link href="<?=PROOT?>css/plugins/iCheck/custom.css" rel="stylesheet">
   <link href="<?=PROOT?>css/plugins/awesome-bootstrap-checkbox/awesome-bootstrap-checkbox.css" rel="stylesheet">
   <link href="<?=PROOT?>css/animate.css" rel="stylesheet">
   <link href="<?=PROOT?>css/style.css" rel="stylesheet">
   <link href="<?=PROOT?>css/custom.css" rel="stylesheet">
   <?= $this->content('head'); ?>
   
</head>
<body class="fixed-nav md-skin">
   <?php
      //echo "<br><br><br><br>";
      // TRAE DATOS DEL USUARIO LOGEADO
      $objUsuario = Users::currentUser();
      $usrId = $objUsuario->id;
      $rolId = $objUsuario->rol_id;
      $usrNoms = $objUsuario->nombre.' '.$objUsuario->apellido;
      
      // TRAE NOMBRE DEL ROL DEL USUARIO ACTUAL
      $objRoles = new RolesController('Roles', '');
      $rolNameArray = $objRoles->buscarNombreRol($rolId);
      foreach($rolNameArray as $rol){
         //echo "NomRol: ".$rol->nomRol."<br>";
         $rolName = $rol->nomRol;
      }
      unset($objRoles);
      unset($rolNameArray);
      
      //ASIGNA ACCESO A ADMINISTRACION Y PARAMETROS
      $administracionAccess = 'display:none;';
      $parametrosAccess = 'display:none;';
      if($rolName=='Administrador del sistema'){
         $administracionAccess = 'display:block;';
         $parametrosAccess = 'display:block;';
      }else if($rolName=='Administrador de información'){
         $parametrosAccess = 'display:block;';
      }
   
      //echo "NomRol: ".$nomRol->nomRol."<br>";
      /*    
      foreach($_SESSION as $objUsuario['userID']=>$valor){
         //echo $objUsuario->userID;
         
         echo('<pre>');
         var_dump($valor);
         echo('</pre>');
         
         if(isset($valor->tipo_documento)){
            $usrId = $valor->id;
            $rolId = $valor->rol_id;
            $usrNoms = $valor->nombre.' '.$valor->apellido;
         }
         //echo $valor["tipo_documento"];
      }
      */
      // VECTOR CON TODOS LOS MODULOS
      $obj_modulos = Modulos::buscarModulos();
      $resp = ['modulos'=>$obj_modulos];  
      
      // VECTOR CON MODULOS ACTIVOS PARA EL ROL ACTUAL
      $objPermisos = new PermisosController('Permisos','');
      $vectorPermisos = $objPermisos->listarModulosPorRol($rolId);
   
      foreach($resp['modulos'] as $modulo){
         //echo str_replace(' ', '',$modulo->modulo)."<br>";
         $nomVar = str_replace(' ', '', $modulo->modulo);
         ${$nomVar} = 'display:none;';
         foreach($vectorPermisos as $permiso){
            if($modulo->modulo==$permiso->modNom){
               ${$nomVar} = 'display:block;';
            }
         
         }
         
         //echo "<strong>Nom</strong>: ".$modulo->modulo." <strong>Estado</strong>: ".${$nomVar}." - <strong>NV:</strong>".$nomVar."<br>";
      }
   
      $objSesion = new Session();
      $objSesion->validarSesion();
   ?>
   <div id="wrapper">
      <nav class="navbar-default navbar-static-side" role="navigation">
         <div class="sidebar-collapse">
            <ul class="nav metismenu" id="side-menu">
               <!--ADMINISTRADOR-->
               <li class="border-bottom" style="<?php echo $administracionAccess; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/administracion.png'>`)">
                     <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/administrador.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">&nbsp; Administrador</span>
                  </a>
                  <ul class="nav nav-second-level collapse">
                     <li>
                        <a href="#" id="sistema" >
                           <span class="fa arrow pr-3"></span>
                           Sistema
                        </a>
                        <!--SEGURIDAD-->
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <span class="fa arrow pr-3"></span>
                                 Seguridad
                              </a>
                              <ul class="nav nav-third-level" id="metismenu">
                                 <li class="mm-active">
                                    <a href="<?=PROOT?>roles" aria-expanded="true">
                                       <i class="fa fa-angle-right" aria-hidden="true"></i>
                                       Roles
                                    </a>
                                 </li>
                                 <li>
                                    <a href="<?=PROOT?>permisos">
                                       <i class="fa fa-angle-right" aria-hidden="true"></i>
                                       Permisos
                                    </a>
                                 </li>
                                 <li>
                                    <a href="<?=PROOT?>users">
                                       <i class="fa fa-angle-right" aria-hidden="true"></i>
                                       Usuarios
                                    </a>
                                 </li>
                                 <!--
                                 <li>
                                    <a href="#">
                                       <i class="fa fa-angle-right" aria-hidden="true"></i>
                                       Tipos de Usuarios
                                    </a>
                                 </li>
                                 -->
                              </ul>
                           </li>
                        </ul>
                        <!--SEGURIDAD-->
                        <ul class="nav nav-third-level">
                           <li class="border-bottom">
                              <a href="#">
                                 <span class="fa arrow pr-3"></span>
                                 Empresas
                              </a>
                              <ul class="nav nav-third-level">
                                 <li>
                                    <a href="<?=PROOT?>empresas">
                                       <i class="fa fa-angle-right" aria-hidden="true"></i>
                                       Gestión de empresas
                                    </a>
                                 </li>
                                 <li>
                                    <a href="<?=PROOT?>tipoEmpresa">
                                       <i class="fa fa-angle-right" aria-hidden="true"></i>
                                       Tipos de empresas
                                    </a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!--PARAMETROS-->
               <li class="border-bottom" style="<?php echo $parametrosAccess; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/parametros.png'>`)">
                                       <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/parametros.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">Parametros</span>
                  </a>
                  <ul class="nav nav-second-level collapse">
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Generales
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="<?=PROOT?>municipio"><span class="fa arrow pr-3"></span>
                                 Municipios
                              </a>
                           </li>
                           <li>
                              <a href="<?=PROOT?>sectores"><span class="fa arrow pr-3"></span>
                                 Sectores
                              </a>
                           </li>
                           <li>
                              <a href="<?=PROOT?>tipoProducto"><span class="fa arrow pr-3"></span>
                                 Tipos de productos
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Arquitectura
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Carga de documentos
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Energía
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Carga de documentos
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Agua
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="<?=PROOT?>adjuntos/agua"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Carga de documentos
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Materiales
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#"><span class="fa arrow pr-3"></span>
                                 Carga de documentos
                              </a>
                           </li>
                           <li>
                              <a href="<?=PROOT?>tipoObra"><span class="fa arrow pr-3"></span>
                                 Tipos de obra
                              </a>
                           </li>
                           <li>
                              <a href="<?=PROOT?>subTipoObra"><span class="fa arrow pr-3"></span>
                                 Subtipos de obra
                              </a>
                           </li>
                           <li>
                              <a href="<?=PROOT?>materialCategoria"><span class="fa arrow pr-3"></span>
                                 Categoria de material
                              </a>
                           </li>
                           <li>
                              <a href="<?=PROOT?>materialTipo"><span class="fa arrow pr-3"></span>
                                 Tipo de material
                              </a>
                           </li>
                           <li>
                              <a href="<?=PROOT?>materialSubTipo"><span class="fa arrow pr-3"></span>
                                 Subtipos de material
                              </a>
                           </li>
                           <li>
                              <a href="#" id="sistema">
                                 <span class="fa arrow pr-3"></span>
                                 Residuos
                              </a>
                              <ul class="nav nav-third-level">
                                 <li>
                                    <a href="<?=PROOT?>residuoClase"><span class="fa arrow pr-3"></span>
                                       Clases de residuo
                                    </a>
                                 </li>
                                 <li>
                                    <a href="<?=PROOT?>residuoCategoria"><span class="fa arrow pr-3"></span>
                                       Categorias del residuo
                                    </a>
                                 </li>
                                 <li>
                                    <a href="<?=PROOT?>residuoTipo"><span class="fa arrow pr-3"></span>
                                       Tipos de residuos
                                    </a>
                                 </li>
                                 <li>
                                    <a href="<?=PROOT?>residuoSubTipo"><span class="fa arrow pr-3"></span>
                                       Subtipos de residuos
                                    </a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Oferta Acádemica
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="<?=PROOT?>tipoOfertaAcademica"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Tipos de oferta
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!--CLASIFICACION CLIMATICA-->
               <li class="border-bottom" style="<?php echo ${'ClasificaciónClimática'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/clasificacion_climatica.png'>`)">
                     <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/sistema.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">&nbsp;Clasificación climática</span>
                  </a>
                  <ul class="nav nav-second-level collapse">
                     <li>
                        
                        <a href="<?=PROOT?>ideam">
                           <span class="fa arrow pr-3"></span>
                           IDEAM
                        </a>
                     </li>
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Bucaramaga
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Descripción del clima
                              </a>
                           </li>
                           <li>
                              <a href="#"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Clasificación climatica IDEAM
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Florida
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Descripción del clima
                              </a>
                           </li>
                           <li>
                              <a href="#"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Clasificación climatica IDEAM
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Piedecuesta
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Descripción del clima
                              </a>
                           </li>
                           <li>
                              <a href="#"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Clasificación climatica IDEAM
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="sistema">
                           <span class="fa arrow pr-3"></span>
                           Girón
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Descripción del clima
                              </a>
                           </li>
                           <li>
                              <a href="#" > <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Clasificación climatica IDEAM
                              </a>
                           </li>
                        </ul>
                     </li>
                  </ul>
               </li>
               <!--PROYECTOS-->
               <li class="border-bottom" style="<?php echo ${'Proyectos'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/proyectos.png'>`)">
                     <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/proyectos.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">&nbsp; Proyectos</span>
                  </a>
                  <ul class="nav nav-second-level collapse">
                     <li>
                        <a href="<?=PROOT?>datosObra/nuevo">
                           <i class="fa fa-angle-right" aria-hidden="true"></i>
                           Incluir proyectos
                        </a>
                        <a href="#">
                           <i class="fa fa-angle-right" aria-hidden="true"></i>
                           Administrar proyectos
                        </a>
                        <a href="#">
                           <i class="fa fa-angle-right" aria-hidden="true"></i>
                           Reportes
                        </a>
                     </li>
                  </ul>
               </li>
               <!--ARQUITECTURA-->
               <li class="border-bottom" style="<?php echo ${'Arquitectura'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/arquitectura.png'>`)">
                     <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/confort.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">Arquitectura</span>
                  </a>
                  <ul class="nav nav-second-level collapse">
                     <li>
                        <a href="#">
                           <span class="fa arrow pr-3"></span>
                           Introducción
                        </a>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Estrategias
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 RVP
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Protección solar
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Ventilación natural
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Valor u envolvente
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Características acristalamiento
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Línea base
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 VIS
                              </a>
                              <ul class="nav nav-third-level">
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Ficha
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Excel
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Dwg
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y4
                              </a>
                              <ul class="nav nav-third-level">
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Ficha
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Excel
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Dwg
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y6
                              </a>
                              <ul class="nav nav-third-level">
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Ficha
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Excel
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Dwg
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas pequeñas
                              </a>
                              <ul class="nav nav-third-level">
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Ficha
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Excel
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Dwg
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas grandes
                              </a>
                              <ul class="nav nav-third-level">
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Ficha
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Excel
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                                 <li>
                                    <a href="#" class="ml-3 pr-3">
                                       Dwg
                                       <span class="fa arrow pt-1"></span>
                                    </a>
                                 </li>
                              </ul>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Método  prescriptivo
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 VIS
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y4
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y6
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas pequeñas
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas grandes
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Método  de desempeño
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Procedimiento de simulación
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Reportes
                        </a>
                     </li>
                  </ul>
               </li>
               <!--ENERGIA-->
               <li class="border-bottom" style="<?php echo ${'Energía'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/energia.png'>`)">
                  <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/energia.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">Energía</span>
                  </a>
                  <ul class="nav nav-second-level collapse">
                     <li>
                        <a href="#">
                           <span class="fa arrow pr-3"></span>
                           Introducción
                        </a>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Estrategias
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Uso racional de energía
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Iluminación
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Equipos
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 HVAC
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Línea base
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 VIS
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y4
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y6
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas pequeñas
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas grandes
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Método  prescriptivo
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 VIS
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y4
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y6
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas pequeñas
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas grandes
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Método  de desempeño
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Procedimiento de simulación
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Reportes
                        </a>
                     </li>
                  </ul>
               </li>
               <!--AGUA-->
               <li class="border-bottom" style="<?php echo ${'Agua'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/agua.png'>`)">
                  <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/agua.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">Agua</span>
                  </a>
                  <ul class="nav nav-second-level collapse">
                     <li>
                        <a href="#">
                           <span class="fa arrow pr-3"></span>
                           Introducción
                        </a>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Estrategias
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Educación y capacitación
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Reconversión de aparatos sanitarios
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Reutilización aguas grises
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Captación uso y manejo de aguas lluvias
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Línea base
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 VIS
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y4
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 E3Y6
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas pequeñas
                              </a>
                           </li>
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Oficinas grandes
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Método  de desempeño
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="#">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Procedimiento de simulación
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Reportes
                        </a>
                     </li>
                  </ul>
               </li>
               <!--MATERIALES-->
               <li class="border-bottom" style="<?php echo ${'Materiales'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/materiales.png'>`)">
                 <img src="<?=PROOT?>img/menu/materiales.png" alt="" width="30px" height="30px">
                      <span class="nav-label text-primary">Materiales</span>
                  </a>
               </li>
               <!--PROVEEDORES-->
               <li class="border-bottom" style="<?php echo ${'Proveedores'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/proveedores.png'>`)">
                     <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/proveedores.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">Proveedores</span>
                  </a>
                  <ul class="nav nav-second-level collapse">
                     <li>
                        <a href="<?=PROOT?>empresas/detalle">
                           <span class="fa arrow pr-3"></span>
                           Incluir Información
                        </a>
                     </li>
                     <li>
                        <a href="<?=PROOT?>productos">
                           <span class="fa arrow pr-3"></span>
                           Productos y/o Servicios
                        </a>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Reportes
                        </a>
                     </li>
                  </ul>
               </li>
               <!--OFERTA Y DEMANDA-->
               <li class="border-bottom"  style="<?php echo ${'OfertayDemanda'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/oferta_demanda.png'>`)">
                     <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/oferta.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">Oferta y demanda</span>
                  </a>
                  <ul class="nav nav-second-level collapse">
                     <li>
                        <a href="<?=PROOT?>ofertas"> <i class="fa fa-angle-right" aria-hidden="true"></i>
                           Presentación
                        </a>
                     </li>
                     <li>
                        <a href="#">
                           <span class="fa arrow pr-3"></span>
                           Visualizar
                        </a>
                        <ul class="nav nav-third-level">
                           <li>
                              <a href="<?=PROOT?>ofertas/listarOfertas">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Listado de ofertas
                              </a>
                           </li>
                           <li>
                              <a href="<?=PROOT?>demandas/listarDemandas">
                                 <i class="fa fa-angle-right" aria-hidden="true"></i>
                                 Listado de demanda
                              </a>
                           </li>
                        </ul>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Gestionar
                        </a>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Reportes
                        </a>
                     </li>
                  </ul>
               </li>
               <!--OFERTA ACADEMICA-->
               <li class="border-bottom"  style="<?php echo ${'OfertaAcademica'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/oferta_academica.png'>`)">
                     <span class="fa arrow pt-1"></span>
                     <img src="<?=PROOT?>img/menu/academico.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">Oferta acádemica</span>
                  </a>
                 <ul class="nav nav-second-level collapse">
                     <li>
                        <a href="<?=PROOT?>ofertaAcademica/index" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Incluir Oferta
                        </a>
                     </li>
                     <li>
                        <a href="#" >
                           <span class="fa arrow pr-3"></span>
                           Gestionar Oferta Acádemica
                        </a>
                     </li>
                     <li>
                        <a href="#" id="empresas">
                           <span class="fa arrow pr-3"></span>
                           Reportes
                        </a>
                     </li>
                  </ul>
               </li>
               <!--REPORTES GENERALES-->
               <li class="border-bottom"  style="<?php echo ${'ReportesGenerales'}; ?>">
                  <a href="#" onClick="mostrarContenidoEnMedio(`<img class='img img-fluid' src='<?=PROOT?>img/menu/presentacion/reportes.png'>`)">
                 <img src="<?=PROOT?>img/menu/reportes.png" alt="" width="30px" height="30px"> 
                     <span class="nav-label text-primary">Reportes generales</span></a>
               </li>
            </ul>
         </div>
      </nav>
      <nav class="navbar navbar-fixed-top" role="navigation" style="margin-bottom: 0;background-color: #293846 !important;">
         <div class="navbar-header">
            <a class="navbar-minimalize minimalize-styl-2 btn btn-primary" href="#"><i class="fa fa-bars fa-2x"></i></a>
            <a class="minimalize-styl-2 btn btn-primary" href="<?=PROOT?>users/index"><i class="fa fa-home fa-2x"></i></a>
            <div  class="minimalize-styl-2 text-white ml-0 font-weight-bold"><h3>CLUSTER DE CONSTRUCCION DE SANTANDER</h3></div>
         </div>
         <ul class="nav navbar-top-links navbar-right mr-3">
            <li>
               <a href="<?=PROOT?>users/logout">
                  <i class="fa fa-sign-out"></i> Salir
               </a>
            </li>
         </ul>
      </nav>
      <div id="page-wrapper" class="gray-bg">
         <div class="wrapper wrapper-content animated fadeInDown">
            <?= Session::displayMsg() ?>
            <?= $this->content('body'); ?>
            <div id="contenido"></div>
         </div>
         <div class="footer text-white" style="background-color: #293846 !important;">
            <strong>Copyright</strong> CLUSTER DE CONSTRUCCIÓN DE SANTANDER. &copy; <?= date('Y');?>
         </div>
      </div>
   </div>
   
   <div class="modal inmodal fade font-weight-bold" id="frmModal" tabindex="-1" role="dialog" aria-labelledby="frmModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg" role="document">
         <div class="modal-content">
            <div class="modal-header">
               <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span><span class="sr-only">Close</span></button>
               <h4 class="modal-title text-decoration" ><u id="modalTitulo">Nuevo Registro</u></h4>
            </div>
            <div class="modal-body" id="bodyModal">
               ...
            </div>
         </div>
      </div>
   </div>



   <!-- Mainly scripts -->
   <script src="<?=PROOT?>js/jquery-3.1.1.min.js"></script>
   <script src="<?=PROOT?>js/popper.min.js"></script>
   <script src="<?=PROOT?>js/bootstrap.min.js"></script>
   <script src="<?=PROOT?>js/plugins/metisMenu/jquery.metisMenu.js"></script>
   <script src="<?=PROOT?>js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
   <script src="<?=PROOT?>js/plugins/sweetalert/sweetalert.min.js"></script>
   <script src="<?=PROOT?>js/plugins/validate/jquery.validate.min.js"></script>

   <!-- Custom and plugin javascript -->
   <script src="<?=PROOT?>js/inspinia.js"></script>
   <script src="<?=PROOT?>js/plugins/pace/pace.min.js"></script>

   <script src="<?=PROOT?>js/alertMsg.js"></script>
   <script src="<?=PROOT?>js/custom.js"></script>

   <?= $this->content('footer'); ?>

<script>
   $(document).ready(function() {
      if (location.href.indexOf("#") > -1) {
          location.assign(location.href.replace(/\/?#/, ""));
      }
      var url = window.location;

      var element = $('.nav a').filter(function() {

         return this.href == url || url.href.indexOf(this.href) == 0; 
      }).parent().addClass('active');

      if (element.is('li')) { 
            element.parent('ul').addClass('collapse in').attr('aria-expanded','true').parent('li').addClass('active');
      }

      element.parent('ul').addClass('collapse in').attr('aria-expanded','true').parent('li').addClass('active');
      element.parent().parent().parent().parent('li').addClass('active').children('a');
      element.parent().parent().parent('ul').attr('aria-expanded','true').addClass('in');
      element.parent().parent().parent().parent().parent().parent('li').addClass('active');
      element.parent().parent().parent().parent().parent().parent('li').children('a').attr('aria-expanded','true');
      element.parent().parent().parent().parent().parent().parent('li').children('ul').addClass('in');
   });

   function mostrarAdjuntoEnModal(adjuntoNom, controller=null){
   // onclick="mostrarAdjuntoEnModal('carperaDentroDeDocumento/archivo.pdf', 'controladorQueInstanciaLaFuncionMostrarAdjunto');"
   url = '<?=PROOT?>documentos/'+adjuntoNom;
   //alert('URL: '+url+' Controller: '+controller);
   //
   if(controller){
      jQuery.ajax({
       url : '<?=PROOT?>'+controller+'/mostrarAdjunto',
       method : "GET",
       data:{
            urlAdjunto:url
       },
       success : function(resp){
         console.log(resp);
         jQuery('#modalTitulo').html('Visor de documentos');
         jQuery('#bodyModal').html(resp);
         jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
         jQuery('#frmModal').modal('show');
       }
      });
   }else{
      var resp='<embed src="'+adjuntoNom+'#toolbar=0&navpanes=0&scrollbar=0"  width="100%" height="600px" ;/>'; 
      jQuery('#modalTitulo').html('Visor de documentos');
      jQuery('#bodyModal').html(resp);
      jQuery('#frmModal').modal({backdrop: 'static', keyboard: false});
      jQuery('#frmModal').modal('show');
   }
}

</script>
</body>
</html>

