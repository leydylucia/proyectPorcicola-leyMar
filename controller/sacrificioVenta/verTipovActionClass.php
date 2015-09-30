<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of verInsumoActionClass  sirve para ver un dato en la grilla 
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * * @category sacrificio venta
 */
class verTipovActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          tipovTableClass::ID,
          tipovTableClass::DESC_TIPOV,
          tipovTableClass::CREATED_AT
      );
      $where = array(
          tipovTableClass::ID => request::getInstance()->getRequest(tipovTableClass::ID)
      );
      $this->objTipoV = tipovTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('verTipov', 'sacrificioVenta', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
