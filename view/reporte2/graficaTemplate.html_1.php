<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\view\viewClass as view ?>
<?php use mvc\i18n\i18nClass as i18n ?>
<?php use mvc\config\configClass as confing ?>
<?php use mvc\request\requestClass as request ?>

<div class="container-fluid reporte">

<script>

    $(document).ready(function () {
        crearGrafica(<?php echo json_encode($cosPoints) ?>);
    });
</script> 

<div id="chart1" style="width: 500px;height: 500px;"></div>

<a href="<?php echo routing::getInstance()->getUrlWeb('reporte2', 'grafica') ?>"class="btn btn-info btn-xs">Generar Pdf</a>

</div>
