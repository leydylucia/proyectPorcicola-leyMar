<?php mvc\view\viewClass::includePartial('insumo/menu') ?>
<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>
<?php
use mvc\view\viewClass as view ?>


<?php $lote = loteTableClass::ID ?>
<!--titulo-->
<div class="container container-fluid">
  <div class="page-header titulo">
    <h1><?php echo i18n::__('new_batch') ?></h1> 
  </div>

</div>
<!--fintitulo-->

<?php view::includePartial('lote/formLote') ?>

