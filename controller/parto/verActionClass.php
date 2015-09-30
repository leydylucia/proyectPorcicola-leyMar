<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 *  Description of updateActionClass esta clase sirve para 
 *  el update carge datos de la tabla y cumple con la funcion de modificar
 *
 * @author Alexandra Florez
 * @category modulo parto
 */
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          partoTableClass::ID,
          partoTableClass::FECHA_NACIMIENTO,
          partoTableClass::NUM_NACIDOS,
          partoTableClass::NUM_VIVOS,
          partoTableClass::NUM_MUERTOS,
          partoTableClass::NUM_HEMBRAS,
          partoTableClass::NUM_MACHOS,
          partoTableClass::FECHA_MONTADA,
          partoTableClass::ID_PADRE,
          partoTableClass::HOJA_VIDA_ID,
          partoTableClass::CREATED_AT
      );
      $where = array(
          partoTableClass::ID => request::getInstance()->getRequest(partoTableClass::ID)
      );
      $this->objParto = partoTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('ver', 'parto', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
