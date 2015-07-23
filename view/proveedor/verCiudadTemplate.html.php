<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $nom_ciudad = ciudadTableClass::NOM_CIUDAD ?>
<?php $depto_id = ciudadTableClass::DEPTO_ID ?>
<?php $created_at = ciudadTableClass::CREATED_AT ?>

<div class="container container-fluid">


  <a href="<?php echo routing::getInstance()->getUrlWeb('proveedor', 'indexCiudad') ?>"><?php echo i18n::__('return') ?> </a>
  <br>
  <br>

</div>



<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr>

      <center> <th>Datos de ciudad</th>     
        </tr>        

        </thead>
      
        <tbody>
<?php foreach ($objCiudad as $ciudad): ?>

          <th><?php echo i18n::__('name_city') ?></th>
          <tr>
            <td><?php echo $ciudad->$nom_ciudad ?></td>

          <tr>
            <th><?php echo i18n::__('name_dept') ?></th>
          <tr>
            <td><?php echo deptoTableClass::getNameDepto($ciudad->$depto_id) ?></td>
          <tr>
            <th><?php echo i18n::__('date_creation') ?></th>
          <tr>
            <td><?php echo $ciudad->$created_at ?></td>

<?php endforeach ?>
          </tbody>



          </table>    
          </div>
          </div>

