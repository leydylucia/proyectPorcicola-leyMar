<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of inventarioInsumoActionClass  sirve para ver los datos en la 
 * grilla sobre los insumos
 * @category modulo insumo
 * @author Leydy Lucia Castillo  <leydylucia@hotmail.com>
 */
class inventarioInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          insumoTableClass::ID,
          insumoTableClass::DESC_INSUMO,
          insumoTableClass::TIPO_INSUMO_ID,
          
        
      );
      $where=null;
      $where[] = '( ' . insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID ) . ' BETWEEN ' . "1" . " AND " . "2".' )';
      $this->objInsumo = insumoTableClass::getAll($fields, true, null, null, null, nuLL, $where);
      $this->defineView('inventarioInsumo', 'insumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
