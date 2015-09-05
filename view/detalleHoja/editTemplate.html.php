<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>

<!--@var $descInsumo para definir que campo voy a modificar-->
<?php $peso_cerdo = detalleHojaTableClass::PESO_CERDO ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('edit_detaill_curriculum_vitae')?></h1>  
        <h2> <?php echo $objDetalleHoja[0]->$peso_cerdo ?></h2>
    </div>
<!--fintitulo-->
<?php view::includePartial('detalleHoja/formDetalleHoja', array('objDetalleHoja' => $objDetalleHoja, 'peso_cerdo' => $peso_cerdo,'objHojaVida' => $objHojaVida,'objInsumo'=>$objInsumo,'objTipoin'=> $objTipoin,'objUnidadMedida'=>$objUnidadMedida)) ?>


</div>