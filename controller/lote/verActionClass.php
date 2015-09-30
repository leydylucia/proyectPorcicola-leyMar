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
 * @category modulo lote
 */
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          loteTableClass::ID,
          loteTableClass::DESC_LOTE,
          loteTableClass::UBICACION,
          loteTableClass::CREATED_AT
      );
      $where = array(
          loteTableClass::ID => request::getInstance()->getRequest(loteTableClass::ID)
      );
      $this->objLote = loteTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('ver', 'lote', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
