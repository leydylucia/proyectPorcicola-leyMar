
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('new_detail_entry')?></h1>  
    </div>
    
</div>
<!--fintitulo-->

<?php view::includeHandlerMessage()?>
<?php view::includePartial('detalle/formDetalle', array('id_entrada_bodega' =>$id_entrada_bodega,'objEntrada' => $objEntrada,'objInsumo'=>$objInsumo,'objUnidadMedida'=>$objUnidadMedida))?>


