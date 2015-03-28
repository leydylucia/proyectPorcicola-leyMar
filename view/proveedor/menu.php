<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\routing\routingClass as routing?>

        <div class="container">      
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 ">          
                    <img class="img-responsive" src="<?php echo routing::getInstance()->getUrlImg('titulomenu.jpg') ?>" alt="test">
                </div>
            </div>
        </div>    

<!--este es el menu-->
<div class="container container-fluid boton1">

  <ul class="nav nav-tabs">
    <li class="active"><a href="#">Inicio</a></li>
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="http://localhost/proyecto/web/index.php/proveedor/"><?php echo i18n::__('supplier') ?>
        <span class="caret"></span></a>
      <ul class="dropdown-menu">
<!--        <li><a href="http://localhost/proyecto/web/index.php/proveedor/ciudad/"></?php echo i18n::__('city') ?></a></li>
        <li><a href="http://localhost/proyecto/web/index.php/depto/"></?php echo i18n::__('departament') ?></a></li>-->
      </ul>
    </li>
    
      
   <li class="dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" href="<?php  echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>">"<?php echo i18n::__('product') ?>
        <span class="caret"></span></a>
      <ul class="dropdown-menu">
<!--        <li><a href="http://localhost/proyecto/web/index.php/insumo/tipoInsumo"><//?php echo i18n::__('type_product') ?></a></li>-->
       <li><a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexTipoin') ?>">tipo insumo</a></li>
       <li><a  href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>">insumo</a></li>
      </ul>
    </li>
    
<!--     <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="http://localhost/proyecto/web/index.php/proveedor/"><//?php echo i18n::__('hoja de vida') ?>
        <span class="caret"></span></a>
      <ul class="dropdown-menu">
        <li><a href="http://localhost/proyecto/web/index.php/insumo/tipoInsumo"><//?php echo i18n::__('type_product') ?></a></li>
       <li><a href="<//?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('raza', 'index') ?>">raza</a></li>
            <li><a href="<//?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('lote', 'index') ?>">lote</a></li>
            <li><a href="<//?php echo \mvc\routing\routingClass::getInstance()->getUrlWeb('parto', 'index') ?>">parto</a></li>
           
      </ul>
    </li>-->
    
  
  </ul>
</div>    

<!--este es el fin del menu-->