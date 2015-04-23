<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->
<?php $ciudad = ciudadTableClass::NOM_CIUDAD ?>
<div class="container container-fluid">
    <div class="page-header titulo">
     <h1>EDITAR CIUDAD </h1>
    <h2>   <?php echo $objCiudad[0]->$ciudad ?>    </h2>
    </div>
 

<?php view::includePartial('proveedor/formCiudad', array('objCiudad' => $objCiudad, 'nom_ciudad' => $ciudad,'objDepto' => $objDepto)) ?>


