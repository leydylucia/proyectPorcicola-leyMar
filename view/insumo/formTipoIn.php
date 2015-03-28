<?php mvc\view\viewClass::includePartial('insumo/menu')?>
<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $id = tipoInsumoTableClass::ID ?>
<?php  $desc_tipoIn  =  tipoInsumoTableClass::DESC_TIPOIN  ?>



<div class="container">
    <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('insumo', ((isset($objTipoIn)) ? 'updateTipoin' : 'createTipoin' )) ?>">
  <?php if(isset($objTipoIn) == true): ?>
        <input name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID,true) ?>" value="<?php echo $objTipoIn[0]->$id ?>" type="hidden">
  <?php endif ?>
    
    
        <div class="form-group">
            <label for="desc_tipoIn" class="control-label col-xs-3"><?php echo i18n::__('describe_typeProduct') ?>:</label>

            <div class="col-xs-9"><input id="desc_tipoIn" class="form-control" value="<?php echo ((isset($objTipoIn) == true) ? $objTipoIn[0]->$desc_tipoIn : '') ?>" type="text" name="<?php echo tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true) ?>">
        </div>


        <br>
 
 <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objTipoIn)) ? 'update' : 'register')) ?>">
 
 <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/tipoIn"><?php echo i18n::__('return') ?> </a>
 


    </form>
</div>

