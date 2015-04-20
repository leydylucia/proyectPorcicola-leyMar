<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\view\viewClass as view ?>

<div class="container container-fluid">
    <div class="page-header titulo">
      <h1><i class="glyphicon glyphicon-user"></i>NUEVO CONTROL PESO</h1>
    </div>
</div>

<?php view::includePartial('control/formControl',array( 'objEmpleado' => $objEmpleado)) ?>


