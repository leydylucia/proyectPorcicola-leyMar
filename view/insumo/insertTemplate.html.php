
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('New Product')?></h1>  
    </div>
    
</div>
<!--fintitulo-->


<?php view::includeHandlerMessage()?>
<?php view::includePartial('insumo/formInsumo', array( 'objTipoin' => $objTipoin,'objProv'=>$objProv))?>


