<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of verActionClass  sirve para ver un dato en la grilla 
 *
 * @author Alexandra Florez
 * @category modulo credencial
 */
class verActionClass extends controllerClass implements controllerActionInterface {
   /* public function execute inicializa las variables 
   * @return $nombre=> nombre del a credencial (string)

   * ** */

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
