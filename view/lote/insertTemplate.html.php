<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('lote', 'create') ?>">

   
    <?php echo i18n::__('desc_lote') ?>:
    

    <input type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::DESC_LOTE, true) ?>">
    
     <?php echo i18n::__('ubicacion') ?>:
    

    <input type="text" name="<?php echo loteTableClass::getNameField(loteTableClass::UBICACION, true) ?>">
    
    <input type="submit" value="<?php echo i18n::__('register') ?>">

</form>
