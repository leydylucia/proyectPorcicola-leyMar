<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>

<!--@var $descInsumo para definir que campo voy a modificar-->
<?php $dosis = vacunacionTableClass::DOSIS ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1><?php echo i18n::__('Edit_Vaccination')?></h1>  
        <h2> <?php echo $objVacunacion[0]->$dosis ?></h2>
    </div>
<!--fintitulo-->
<?php view::includePartial('vacunacion/formVacunacion', array('objVacunacion' => $objVacunacion, 'dosis' => $dosis,'objInsumo' => $objInsumo,'objHojaVida'=>$objHojaVida )) ?>


</div>