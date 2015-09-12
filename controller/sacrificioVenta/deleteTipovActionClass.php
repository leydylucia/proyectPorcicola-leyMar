<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of ejemploClass
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * * @category sacrificio venta
 */
class deleteTipovActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(tipovTableClass::getNameField(tipovTableClass::ID, true));
        
        $ids = array(
        tipovTableClass::ID => $id
        );
        tipovTableClass::delete($ids, true);/*el true es para el borrado logico false si no lo tiene*/
        //routing::getInstance()->redirect('depto', 'index');
        $this->arrayAjax=array(
           'code'=>200,
           'msg' =>'la eliminacion fue exitosa'
            
        );
        $this->defineView('deleteTipov', 'sacrificioVenta',session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('el registro se elimino con exito');/*mensaje de exito*/
        log::register('eliminar', tipovTableClass::getNameTable()); //linea de bitacora
      } else {
        routing::getInstance()->redirect('sacrificioVenta', 'indexTipov');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
