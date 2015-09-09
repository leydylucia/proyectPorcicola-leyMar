<?php

use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\routing\routingClass as routing ?>
<?php
use mvc\view\viewClass as view ?> 
<?php

use mvc\config\configClass as config ?>
<?php
use mvc\request\requestClass as request ?>
<?php
use mvc\session\sessionClass as session ?>



<div class="container container-fluid imagen"  >      
    <div class="row">
        <div class="col-lg-12 " id="prueba">          
            <img class="img-responsive" src="<?php echo routing::getInstance()->getUrlImg('fondopasto.jpg') ?>" alt="test">
        </div>
    </div>
</div>    

<!--este es el menu-->
<div class="container container-fluid boton1">

    <div class="container container-fluid body">  
        <ul class="nav nav-tabs">



            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="</?php  echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><button type="button" class="btn btn-default" aria-label="Left Align">
                        <span class="glyphicon glyphicon-home " aria-hidden="true"></span>
                    </button><//?php echo i18n::__('') ?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">


                    <li><a  href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?>"><i class=""aria-label="Left Align">
                            </i>
                            <li><a href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>"><?php echo i18n::__('user') ?></a></li>
                            <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>"><?php echo i18n::__('credential') ?></a></li>
                            <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('empleado', 'index') ?>"><?php echo i18n::__('empleyeed') ?></a></li>
                            <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'indexUsuarioCredencial') ?>"><?php echo i18n::__('UserCredential') ?></a></li>

                            </button></a></li>
                </ul>
            </li>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#"><?php echo i18n::__('Reg.supplier') ?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">

                    <li><a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexProv') ?>"><?php echo i18n::__('provisioner') ?></a></li>
                    <li><a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexCiudad') ?>"><?php echo i18n::__('city') ?></a></li>

                </ul>
            </li>


            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><?php echo i18n::__('Reg.Product') ?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <!--        <li><a href="http://localhost/proyecto/web/index.php/insumo/tipoInsumo"><//?php echo i18n::__('type_product') ?></a></li>-->
                    <li><a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexTipoin') ?>"><?php echo i18n::__('type_product') ?></a></li>
                    <li><a  href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><?php echo i18n::__('product') ?></a></li>

                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><?php echo i18n::__('pig') ?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <!--        <li><a href="http://localhost/proyecto/web/index.php/insumo/tipoInsumo"><//?php echo i18n::__('type_product') ?></a></li>-->
                    <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('lote', 'index') ?>"><?php echo i18n::__('batch') ?></a></li>
                    <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('animal', 'index') ?>"><?php echo i18n::__('curriculum vitae') ?></a></li>
                    <li><a href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'indexTipov') ?>"><?php echo i18n::__('type_sale') ?></a></li>
                    <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('sacrificioVenta', 'indexSacrificioVenta') ?>"><?php echo i18n::__('sacrifice') ?></a></li>
                    <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('vacunacion', 'indexVacunacion') ?>"><?php echo i18n::__('Vaccination') ?></a></li>
                    <li><a  href="<?php echo routing::getInstance()->getUrlWeb('control', 'index') ?>"><?php echo i18n::__('weight control') ?></a></li>
                    <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('parto', 'index') ?>"><?php echo i18n::__('delivery') ?></a></li>

                    
                    

                    
                </ul>
            </li>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><?php echo i18n::__('cellar') ?>
                    <span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <!--        <li><a href="http://localhost/proyecto/web/index.php/insumo/tipoInsumo"><//?php echo i18n::__('type_product') ?></a></li>-->
                    <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('entrada', 'indexEn') ?>"><?php echo i18n::__('cellar entry') ?></a></li>
                    <li class="dropdown"><a href="<?php echo routing::getInstance()->getUrlWeb('salidaBodega', 'indexSalidaBodega') ?>"><?php echo i18n::__('Hold_Out') ?></a></li>
                </ul>
            </li>
            
             


            <ul class="nav navbar-nav navbar-right">
                <li><a href="<?php  echo routing::getInstance()->getUrlWeb('reporte', 'index') ?> "><?php  echo i18n::__('Report') ?></a></li>
                <li><a href="#"><i class="glyphicon glyphicon-user"> <?php echo session::getInstance()->getUserName() ?></i></a></li>
                <li><a href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?> "><?php echo i18n::__('session') ?></a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo i18n::__('language') ?><span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'traductor', array('language' => 'es', 'PATH_INFO' => request::getInstance()->getServer('PATH_INFO'), 'QUERY_STRING' => htmlentities(request::getInstance()->getServer('QUERY_STRING')))) ?>"><img class="img-responsive"  id="imgespanol" src="" alt=" "></a></li>
                        <li><a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'traductor', array('language' => 'en', 'PATH_INFO' => request::getInstance()->getServer('PATH_INFO'), 'QUERY_STRING' => htmlentities(request::getInstance()->getServer('QUERY_STRING')))) ?>"><img class="img-responsive"  id="imgingles" src="" alt=" "></a></li>
                    </ul>
                </li>
            </ul>


        </ul>
    </div>
</div>   


<!--este es el fin del menu-->
