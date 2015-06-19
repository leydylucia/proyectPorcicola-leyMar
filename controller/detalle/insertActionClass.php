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
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('form_' . detalleEntradaTableClass::getNameTable())) {
        $this->detalle = session::getInstance()->getAttribute('form_' . detalleEntradaTableClass::getNameTable());
      }
      
      /* fields para foraneas */
      $fields = array(
          entradaTableClass::ID,
      );
      $orderBy = array(
          entradaTableClass::ID
      );
      $this->objEntrada = entradaTableClass::getAll($fields, true, $orderBy, 'ASC');
      
      /* fields para foraneas */
      $fieldsE = array(
          insumoTableClass::ID,
          insumoTableClass::DESC_INSUMO
      );
      $orderByE = array(
          insumoTableClass::DESC_INSUMO
      );
      $this->objInsumo = insumoTableClass::getAll($fieldsE, true, $orderByE, 'ASC');


      $this->defineView('insert', 'detalle', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
