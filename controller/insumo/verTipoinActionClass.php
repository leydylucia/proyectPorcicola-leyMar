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
 *@category modulo insumo
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class verTipoInActionClass extends controllerClass implements controllerActionInterface {

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
      $this->objTipoin = tipoInsumoTableClass::getAll($fields, true, null,null,null,nULL,$where);
      $this->defineView('verTipoin', 'insumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
