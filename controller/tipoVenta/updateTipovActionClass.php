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
class updateTipovActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(tipovTableClass::getNameField(tipovTableClass::ID, true));
        $desc_tipoV= request::getInstance()->getPost(tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true));
       
        $ids = array(
        tipovTableClass::ID => $id
        );

        $data = array(
        tipovTableClass::DESC_TIPOV => $desc_tipoV,
           
        );

       tipovTableClass::update($ids, $data);
      }

      routing::getInstance()->redirect('tipoVenta', 'indexTipov');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
