<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>

<!--@var $descInsumo para definir que campo voy a modificar-->
<?php $usuario = usuarioCredencialTableClass::USUARIO_ID ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Edit_userCredential')?></h1>  
        <h2> <?php echo $objUsuarioCredencial[0]->$usuario ?></h2>
    </div>
<!--fintitulo-->
<?php view::includePartial('usuarioCredencial/formUsuarioCredencial', array('objUsuarioCredencial' => $objUsuarioCredencial, 'usuario' => $usuario,'objUsuario' => $objUsuario,'objCredencial'=>$objCredencial )) ?>


</div>