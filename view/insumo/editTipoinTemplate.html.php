<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->
<?php  $desc_tipoIn = tipoInsumoTableClass::DESC_TIPOIN ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Edit_typeProduct')?></h1>  
        <h2> <?php echo $objTipoin[0]->$desc_tipoIn ?></h2>
    </div>
    
</div>
<!--fintitulo-->

<?php view::includePartial('insumo/formTipoIn', array('objTipoin' => $objTipoin, 'desc_tipoIn' => $desc_tipoIn)) ?>