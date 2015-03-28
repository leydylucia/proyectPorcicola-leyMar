<?php use mvc\routing\routingClass as routing ?>
<?php use mvc\i18n\i18nClass as i18n ?>

<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('estado', 'create') ?>">

   
    <?php echo i18n::__('desc_estado') ?>:

    <input type="text" name="<?php echo estadoTableClass::getNameField(estadoTableClass::DESC_ESTADO, true) ?>">
    
    <input type="submit" value="<?php echo i18n::__('register') ?>">

</form>
