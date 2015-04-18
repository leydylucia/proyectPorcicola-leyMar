<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<div class="container container-fluid">
    <div class="page-header titulo">
     <h1>EDITAR CIUDAD </h1>
    
    </div>
 <?php $ciudad = ciudadTableClass::NOM_CIUDAD ?>
<h1>   <small><?php echo $objCiudad[0]->$ciudad ?></small>    </h1>
<?php view::includePartial('proveedor/formCiudad', array('objCiudad' => $objCiudad, 'nom_ciudad' => $ciudad,'objDepto' => $objDepto)) ?>