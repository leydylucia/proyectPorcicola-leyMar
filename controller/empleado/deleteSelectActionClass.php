<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;

use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
/**
 * Description of deleterSelectActionClass esta clase sirve para eliminar datos en masa
  *@author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo empleado
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {/*se grago el and resquest etc..*/
      if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) /*el chk es para escojer varios dator por medio del cheklist*/
        {
          
          
        
        $idsToDelete = request::getInstance()->getPost('chk');
        
        
        foreach ($idsToDelete as $id) {
          $ids = array(
              empleadoTableClass::ID => $id
          );
          empleadoTableClass::delete($ids, true);
        }
        /*session para  mensaje*/
        session::getInstance()->setSuccess('elementos eliminados');
//        session::getInstance()->setSucces();
        
        
        routing::getInstance()->redirect('empleado', 'index');
      } else {
        routing::getInstance()->redirect('empleado', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}