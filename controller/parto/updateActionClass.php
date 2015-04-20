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
 * @author Alexandra Florez
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::ID, true));
        $fecha_nacimiento = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::FECHA_NACIMIENTO, true));
        $num_nacidos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_NACIDOS, true));
        $num_vivos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_VIVOS, true));
        $num_muertos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_MUERTOS, true));
        $num_hembras = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_HEMBRAS, true));
        $num_machos = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::NUM_MACHOS, true));
        $fecha_montada = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::FECHA_MONTADA, true));
        $id_padre = request::getInstance()->getPost(partoTableClass::getNameField(partoTableClass::ID_PADRE, true));
       
        $ids = array(
            partoTableClass::ID => $id
        );

        $data = array(
            partoTableClass::FECHA_NACIMIENTO => $fecha_nacimiento,
           
        );

        partoTableClass::update($ids, $data);
      }

      routing::getInstance()->redirect('parto', 'index');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
