<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of ejemploClass
 *
 *@author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * * @category sacrificio venta
 */
class editTipovActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet(tipovTableClass::ID)) {
        $fields = array(
        tipovTableClass::ID,
        tipovTableClass::DESC_TIPOV,
          
        );
        $where = array(
        tipovTableClass::ID => request::getInstance()->getGet(tipovTableClass::ID)
        );
        $this->objTipoV= tipovTableClass::getAll($fields, true, null, null, null, null, $where);
        $this->defineView('editTipov', 'sacrificioVenta', session::getInstance()->getFormatOutput());
        log::register('editar', tipovTableClass::getNameTable()); //linea de bitacora
        
      } else {
        routing::getInstance()->redirect('sacrificioVenta', 'indexTipov');
        session::getInstance()->setSuccess('el registro se modifico exitosamente');/*mensaje de exito*/
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
