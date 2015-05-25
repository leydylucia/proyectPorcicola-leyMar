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
      if (request::getInstance()->hasGet(credencialTableClass::ID)) {
        $fields = array(
            credencialTableClass::ID,
            credencialTableClass::NOMBRE,
            );

        $where = array(
            credencialTableClass::ID => request::getInstance()->getGet(credencialTableClass::ID)
        );
        $this->objCredencial = credencialTableClass::getAll($fields, true, null, null, null, null, $where);
        
        
        $this->defineView('edit', 'credencial', session::getInstance()->getFormatOutput());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('credencial', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
