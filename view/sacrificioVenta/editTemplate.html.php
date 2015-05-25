<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $descInsumo para definir que campo voy a modificar-->
<?php $valor = sacrificiovTableClass::VALOR ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Edit_Sacrifice')?></h1>  
        <h2> <?php echo $objSacrificioV[0]->$valor ?></h2>
    </div>
<!--fintitulo-->
<?php view::includePartial('sacrificioVenta/formSacrificioVenta', array('objSacrificioV' => $objSacrificioV, 'valor' => $valor, 'objTipoV' => $objTipoV,'objHojaVida'=>$objHojaVida)) ?>


</div>