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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          credencialTableClass::ID,
          credencialTableClass::NOMBRE,
          credencialTableClass::CREATED_AT
      );
      $where = array(
          credencialTableClass::ID => request::getInstance()->getRequest(credencialTableClass::ID)
      );
      $this->objCredencial = credencialTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('ver', 'credencial', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
