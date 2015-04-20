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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $desc_raza = request::getInstance()->getPost(razaTableClass::getNameField(razaTableClass::DESC_RAZA, true));
        

       if (strlen($desc_raza) > razaTableClass::DESC_RAZA_LENGTH) {
         throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => razaTableClass::DESC_RAZA_LENGTH)), 00001);
        }

        $data = array(
            razaTableClass::DESC_RAZA => $desc_raza
  
        );
        razaTableClass::insert($data);
        routing::getInstance()->redirect('raza', 'index');
      } else {
        routing::getInstance()->redirect('raza', 'index');
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

