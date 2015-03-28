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
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class verTipoinActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
      tipoInsumoTableClass::ID,
      tipoInsumoTableClass::DESC_TIPOIN,
      tipoInsumoTableClass::CREATED_AT
      );
      $where = array(
      tipoInsumoTableClass::ID=>  request::getInstance()->getRequest(tipoInsumoTableClass::ID)
      );
      $this->objTipoIn = tipoInsumoTableClass::getAll($fields, true, null,null,null,nULL,$where);
      $this->defineView('verTipoin', 'insumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
