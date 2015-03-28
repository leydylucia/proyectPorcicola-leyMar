<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $descInsumo para definir que campo voy a modificar-->
<?php $descInsumo = insumoTableClass::DESC_INSUMO ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1>Editar Insumo</h1>  
      <?php echo $objInsumo[0]->$descInsumo ?>
    </div>
    
</div>
<!--fintitulo-->
<?php view::includePartial('insumo/formInsumo', array('objInsumo' => $objInsumo, 'descInsumo' => $descInsumo,'objTipoin' => $objTipoin,'objProv'=>$objProv )) ?>


