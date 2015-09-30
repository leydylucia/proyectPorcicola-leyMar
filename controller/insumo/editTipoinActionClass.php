<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log;/*linea de la bitacora*/

/**
 *  Description of editTipoInActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de modificar datos
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo insumo
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


//        log::register('editar', tipoInsumoTableClass::getNameTable()); //linea de bitacora
      } else {
        routing::getInstance()->redirect('insumo', 'indexTipoin');
        session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
