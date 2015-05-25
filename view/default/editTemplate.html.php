<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<?php $usuario = usuarioTableClass::USER ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Edit User')?></h1>  
        <h2> <?php echo $objUsuario[0]->$usuario ?></h2>
    </div>
<!--fintitulo-->

<?php view::includePartial('default/formUser', array('objUsuario' => $objUsuario, 'usuario' => $usuario)) ?>



<!--titulo-->

