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
class editTipovActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasRequest(tipovTableClass::ID)) {
        $fields = array(
        tipovTableClass::ID,
        tipovTableClass::DESC_TIPOV,
          
        );
        $where = array(
        tipovTableClass::ID => request::getInstance()->getRequest(tipovTableClass::ID)
        );
        $this->objTipoV= tipovTableClass::getAll($fields, true, null, null, null, null, $where);
        $this->defineView('editTipov', 'tipoVenta', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('el registro se modifico exitosamente');/*mensaje de exito*/
        
      } else {
        routing::getInstance()->redirect('tipoVenta', 'indexTipov');
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
