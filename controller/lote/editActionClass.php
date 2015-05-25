<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet(loteTableClass::ID)) {
        $fields = array(
            loteTableClass::ID,
            loteTableClass::DESC_LOTE,
            loteTableClass::UBICACION
        );

        $where = array(
            loteTableClass::ID => request::getInstance()->getGet(loteTableClass::ID)
        );
        $this->objLote = loteTableClass::getAll($fields, true, null, null, null, null, $where);

        $this->defineView('edit', 'lote', session::getInstance()->getFormatOutput());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('lote', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
