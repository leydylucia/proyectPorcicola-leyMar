<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $detalle = detalleEntradaTableClass::CANTIDAD ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1>EDITAR DETALLE BODEGA </h1>
        <h2><?php echo $objDetalle[0]->$detalle ?></h2>
    </div>
    
</div>
<!--fintitulo-->



<?php view::includePartial('detalle/formDetalle', array('objInsumo' => $objInsumo)) ?>


