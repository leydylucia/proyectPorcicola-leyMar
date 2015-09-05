
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('new_detaill_curriculum_vitae')?></h1>  
    </div>
    
</div>
<!--fintitulo-->

<?php view::includeHandlerMessage()?>
<?php view::includePartial('detalleHoja/formDetalleHoja', array('id_hoja_vida' =>$id_hoja_vida,'objHojaVida' => $objHojaVida,'objInsumo'=>$objInsumo,'objTipoin'=>$objTipoin,'objUnidadMedida'=>$objUnidadMedida))?>


