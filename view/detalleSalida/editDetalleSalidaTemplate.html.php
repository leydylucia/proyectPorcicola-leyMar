<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>

<!--@var $descInsumo para definir que campo voy a modificar-->
<?php $cantidad = detalleSalidaTableClass::CANTIDAD ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Output_edit_detail_winery')?></h1>  
        <h2> <?php echo $objDetalleSalida[0]->$cantidad ?></h2>
    </div>
<!--fintitulo-->
<?php view::includePartial('detalleSalida/formDetalleSalida', array('objDetalleSalida' => $objDetalleSalida, 'cantidad' => $cantidad,'objSalidaBodega' => $objSalidaBodega,'objInsumo'=>$objInsumo)) ?>


</div>