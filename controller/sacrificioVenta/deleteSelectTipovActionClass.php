<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description esta cumple una funcion es para el eliminado en masa
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * * @category sacrificio venta
 */
class deleteSelectTipovActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {/* se grago el and resquest etc.. */
      if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {

        $idsToDelete = request::getInstance()->getPost('chk');

        foreach ($idsToDelete as $id) {
          $ids = array(
              tipovTableClass::ID => $id
          );
          tipovTableClass::delete($ids, true);
        }
        /* session para  mensaje */
        session::getInstance()->setSuccess('los Elementos seleccionas fueron eliminados con exito');
        //  session::getInstance()->setSucces('los Elementos seleccionas fueron eliminados con exito');

        routing::getInstance()->redirect('sacrificioVenta', 'indexTipov');
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
