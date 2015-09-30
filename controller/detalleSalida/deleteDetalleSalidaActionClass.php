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
  Description of deleteActionClass esta clase sirve para eliminar datos individuales
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo detallSalida
 */
class deleteDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {
  /*   * @var $ids=> declara con que id va a borrar
   * @var  $this->arrayAjax que el dato que va a la vista es de tipo ajax* */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, true));

        $ids = array(
            detalleSalidaTableClass::ID => $id
        );
        detalleSalidaTableClass::delete($ids, true); /* el true es para el borrado logico  en bd false si no lo tiene */

        $this->arrayAjax = array(
            'code' => 200,
            'msg' => 'la eliminacion fue exitosa'
        );
        $this->defineView('deleteDetalleSalida', 'detalleSalida', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('el registro se elimino con exito'); /* mensaje de exito */
//                 log::register('eliminar',  detalleSalidaTableClass::getNameTable());//linea de bitacora
      } else {
        routing::getInstance()->redirect('detalleSalida', 'indexDetalleSalida');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
