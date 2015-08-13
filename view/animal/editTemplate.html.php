<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $hojaVida = hojaVidaTableClass::ID ?>
<!--titulo-->
<div class="container container-fluid">
    <div class="page-header titulo">
        <h1>EDITAR HOJA DE VIDA CERDO </h1>
        <h2><?php echo $objHojaVida[0]->$hojaVida ?></h2>
    </div>
    

<!--fintitulo-->



<?php view::includePartial('animal/formAnimal', array('objHojaVida' => $objHojaVida, 'id' => $hojaVida,'objLote' => $objLote, 'objEstado' => $objEstado, 'objRaza' => $objRaza, 'objGenero' => $objGenero)) ?>


</div>