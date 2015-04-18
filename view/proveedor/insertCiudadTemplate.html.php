<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>

<div class="container container-fluid">
    <div class="page-header titulo">
     <h1><?php echo i18n::__('new_city') ?></h1>
    </div>

<?php view::includePartial('proveedor/formCiudad',array( 'objDepto' => $objDepto)) ?>

