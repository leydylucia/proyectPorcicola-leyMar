<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->
<?php  $desc_tipoV = tipovTableClass::DESC_TIPOV ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1>Editar Tipo Venta</h1>  
        <?php echo $objTipoV[0]->$desc_tipoV ?>
    </div>
    
</div>
<!--fintitulo-->

<?php view::includePartial('tipoVenta/formTipov', array('objTipov' => $objTipoV, 'desc_tipoV' => $desc_tipoV)) ?>