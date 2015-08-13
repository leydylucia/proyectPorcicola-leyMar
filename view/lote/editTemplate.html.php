<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>
<!--@var $depto para definir que campo voy a modificar-->

<?php $lote = loteTableClass::ID ?>
<!--titulo-->
<div class="container container-fluid">
  <div class="page-header titulo">
    <h1>EDITAR LOTE </h1>
    <h2><?php echo $objLote[0]->$lote ?></h2>
  </div>

</div>
<!--fintitulo-->



<?php view::includePartial('lote/formLote', array('objLote' => $objLote, 'desc_lote' => $lote)) ?>



