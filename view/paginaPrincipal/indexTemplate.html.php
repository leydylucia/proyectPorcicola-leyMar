<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?> 
<?php use mvc\view\viewClass as view ?> 
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as config ?>
<?php use mvc\request\requestClass as request ?>


<div class="container container-fluid">
    <div class="page-header titulo">
<!--        <h1>Bienvenido</h1>  -->
<h1><?php echo i18n::__('welcome')?></h1>  
    </div>

</div>