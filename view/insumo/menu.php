<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\routing\routingClass as routing?>






        <div class="container container-fluid imagen"  >      
            <div class="row">
                <div class="col-lg-12 " id="prueba">          
                    <img class="img-responsive" src="<?php echo routing::getInstance()->getUrlImg('prueba.jpg') ?>" alt="test">
                </div>
            </div>
        </div> 
<!--<div class="container container-fluid base">-->

<!--este es el menu-->
<div class="container container-fluid boton1">
<div class="container container-fluid body">
  <ul class="nav nav-tabs">
      
      <li class="dropdown">
          <a class="dropdown-toggle" data-toggle="dropdown" href="</?php  echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><i class="glyphicon glyphicon-home"></i></?php echo i18n::__('') ?>
        <span class="caret"></span></a>
      <ul class="dropdown-menu">

       <!--<li><a href="</?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'login') ?>">login</a></li>-->
       <li><a  href="<?php echo routing::getInstance()->getUrlWeb('shfSecurity', 'logout') ?>"><i class="glyphicon glyphicon-log-out"><?php echo i18n::__('closing session')?></a></i></li>
      </ul>
    </li>
    
    <li><a href="<?php echo routing::getInstance()->getUrlWeb('default', 'index') ?>"><?php echo i18n::__('user') ?></a></li>
    </li>
    
    
    
    
    <li class="dropdown">
      <a class="dropdown-toggle" data-toggle="dropdown" href="http://localhost/proyecto/web/index.php/proveedor/"><?php echo i18n::__('supplier') ?>
        <span class="caret"></span></a>
      <ul class="dropdown-menu">
<!--        <li><a href="http://localhost/proyecto/web/index.php/proveedor/ciudad/"></?php echo i18n::__('city') ?></a></li>
        <li><a href="http://localhost/proyecto/web/index.php/depto/"></?php echo i18n::__('departament') ?></a></li>-->
<li><a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexProv') ?>"><?php echo i18n::__('provisioner') ?></a></li>
<li><a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexCiudad') ?>"><?php echo i18n::__('city') ?></a></li>
<li><a href="<?php echo routing::getInstance()->getUrlWeb('depto', 'indexDepto') ?>"><?php echo i18n::__('departament') ?></a></li>
      </ul>
    </li>
    
      
   <li class="dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" href="<?php  echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><?php echo i18n::__('product') ?>
        <span class="caret"></span></a>
      <ul class="dropdown-menu">
<!--        <li><a href="http://localhost/proyecto/web/index.php/insumo/tipoInsumo"><//?php echo i18n::__('type_product') ?></a></li>-->
       <li><a href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexTipoin') ?>"><?php echo i18n::__('type_product') ?></a></li>
       <li><a  href="<?php echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><?php echo i18n::__('product') ?></a></li>
      </ul>
    </li>
    
    
     <li class="dropdown">
       <a class="dropdown-toggle" data-toggle="dropdown" href="</?php  echo routing::getInstance()->getUrlWeb('insumo', 'indexInsumo') ?>"><?php echo i18n::__('sacrifice') ?>
        <span class="caret"></span></a>
      <ul class="dropdown-menu">

       <li><a href="<?php echo routing::getInstance()->getUrlWeb('tipoVenta', 'indexTipov') ?>"><?php echo i18n::__('type sale') ?></a></li>
       
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
</div>
<!--este es el fin del menu-->