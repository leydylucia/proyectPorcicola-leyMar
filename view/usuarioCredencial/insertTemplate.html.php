<?php

use mvc\routing\routingClass as routing ?>
<?php
use mvc\i18n\i18nClass as i18n ?>

<form method="post" action="<?php echo routing::getInstance()->getUrlWeb('usuarioCredencial', 'create') ?>">

    <?php echo i18n::__('fecha', $cultureb = NULL, $dictionary = 'usuarioCredencial') ?>:

    <input type="datetime-local" name="<?php echo usuTableClass::getNameField(usuTableClass::UPDATED_AT, true) ?>">

    <?php echo i18n::__('user', $cultureb = NULL, $dictionary = 'usuarioCredencial') ?>:

    <input type="text" name="<?php echo usuTableClass::getNameField(usuTableClass::USUARIO_ID, true) ?>">
    <?php echo i18n::__('credencial', $cultureb = NULL, $dictionary = 'usuarioCredencial') ?>:

    <input type="text" name="<?php echo usuTableClass::getNameField(usuTableClass::CREDENCIAL_ID, true) ?>">
    <input type="submit" value="<?php echo i18n::__('register', $cultureb = NULL, $dictionary = 'usuarioCredencial') ?>">

</form>