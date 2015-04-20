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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $desc_estado = request::getInstance()->getPost(estadoTableClass::getNameField(estadoTableClass::DESC_ESTADO, true));
        

       if (strlen($desc_estado) > estadoTableClass::DESC_ESTADO_LENGTH) {
         throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => estadoTableClass::DESC_ESTADO_LENGTH)), 00001);
        }

        $data = array(
            estadoTableClass::DESC_ESTADO => $desc_estado
  
        );
        estadoTableClass::insert($data);
        routing::getInstance()->redirect('estado', 'index');
      } else {
        routing::getInstance()->redirect('estado', 'index');
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

