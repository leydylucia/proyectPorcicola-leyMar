<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $credencial = credencialTableClass::NOMBRE ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1>EDITAR CREDENCIAL</h1>
        <h2><?php echo $objCredencial[0]->$credencial ?></h2>
    </div>
    
</div>
<!--fintitulo-->



<?php view::includePartial('credencial/formCredencial', array('objCredencial' => $objCredencial)) ?>


