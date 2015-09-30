<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
  Description of verActionClass  sirve para ver un dato en la grilla
 *
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo entrada
 */
class verEnActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          entradaTableClass::ID,
          entradaTableClass::EMPLEADO_ID,
          entradaTableClass::PROVEEDOR_ID,
          entradaTableClass::CREATED_AT
      );
      $where = array(
          entradaTableClass::ID => request::getInstance()->getRequest(entradaTableClass::ID)
      );
      $this->objEntrada = entradaTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('verEn', 'entrada', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
