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
 *@author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class editTipoInActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet(tipoInsumoTableClass::ID)) {
        $fields = array(
        tipoInsumoTableClass::ID,
        tipoInsumoTableClass::DESC_TIPOIN,
          
        );
        $where = array(
        tipoInsumoTableClass::ID => request::getInstance()->getGet(tipoInsumoTableClass::ID)
        );
        $this->objTipoin = tipoInsumoTableClass::getAll($fields, true, null, null, null, null, $where);
        $this->defineView('editTipoin', 'insumo', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('el registro se modifico exitosamente');/*mensaje de exito*/
        
      } else {
        routing::getInstance()->redirect('insumo', 'indexTipoin');
      }

    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
