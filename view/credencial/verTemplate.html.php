<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $nombre = credencialTableClass::NOMBRE ?>
<?php $created_at = credencialTableClass::CREATED_AT ?>


<div class="container container-fluid">


  <a href="<?php echo routing::getInstance()->getUrlWeb('credencial', 'index') ?>"><?php echo i18n::__('return') ?> </a>

</div>



<div class="container">
  <div class="table-responsive">
    <table class="table table-bordered table-striped table-condensed">
      <thead>
        <tr class="active">

          <th>datos de credencial</th>



        </tr>        
      </thead>
      <tbody>
        <tr><?php foreach ($objCredencial as $credencial): ?> </tr>
        <tr class="info">
            <th><?php echo i18n::__('name') ?></th>

            <td><?php echo $credencial->$nombre ?></td>

        <tr class="active">
            <th><?php echo i18n::__('date_creation') ?></th>
            <td><?php echo $credencial->$created_at ?></td>

<?php endforeach ?>
      </tbody>
    </table>    
  </div>
</div>

