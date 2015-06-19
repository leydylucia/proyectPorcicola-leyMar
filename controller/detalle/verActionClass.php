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
          detalleEntradaTableClass::ID,
          detalleEntradaTableClass::CANTIDAD,
          detalleEntradaTableClass::VALOR,
          detalleEntradaTableClass::ENTRADA_BODEGA_ID,
          detalleEntradaTableClass::INSUMO_ID,
          detalleEntradaTableClass::CREATED_AT
      );
      $where = array(
          detalleEntradaTableClass::ID => request::getInstance()->getRequest(detalleEntradaTableClass::ID)
      );
      $this->objDetalle = detalleEntradaTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('ver', 'detalle', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
