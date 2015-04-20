<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<?php $idEstado = estadoTableClass::ID ?>
<?php $descEst = estadoTableClass::DESC_ESTADO ?>


<!--esto es boostrap no te el olvides de cerrar el div-->
<div class="container"><!--en form tan solo se agrega el role y class para hacer boostrap-->
    <form  role="form" class="form-horizontal" method="post" action="<?php echo routing::getInstance()->getUrlWeb('estado', ((isset($objEstado)) ? 'update' : 'create' )) ?>">
  <?php if(isset($objEstado) == true): ?>
      <input name="<?php echo estadoTableClass::getNameField(EstadoTableClass::ID,true) ?>" value="<?php echo $objEstado[0]->$idEstado ?>" type="hidden">
  <?php endif ?>
    
    
        <div class="form-group">
            <label for="desc_estado" class="control-label col-xs-3"><?php echo i18n::__('desc_estado') ?>:</label>

            <div class="col-xs-9"><input id="desc_estado" class="form-control" value="<?php echo ((isset($objEstado) == true) ? $objEstado[0]->$desc_estado : '') ?>" type="text" name="<?php echo estadoTableClass::getNameField(estadoTableClass::DESC_ESTADO, true) ?>">
        </div>


        <br>
 
 <input type="submit" class="btn btn-success btn-sm" value="<?php echo i18n::__(((isset($objEstado)) ? 'update' : 'register')) ?>">
 
 <a href="http://localhost/proyectPorcicola-leyMar/web/index.php/estado"><?php echo i18n::__('volver') ?> </a>
 


    </form>
</div>

