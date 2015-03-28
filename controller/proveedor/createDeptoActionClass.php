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
class createDeptoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nom_depto = request::getInstance()->getPost(deptoTableClass::getNameField(deptoTableClass::NOM_DEPTO, true));
        

       if (strlen($nom_depto) > deptoTableClass::NOM_DEPTO_LENGTH) {
         throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => deptoTableClass::NOM_DEPTO_LENGTH)), 00001);
        }

        $data = array(
            deptoTableClass::NOM_DEPTO => $nom_depto
  
        );
        deptoTableClass::insert($data);
        
        session::getInstance()->setSuccess('Registro Exitoso');
        routing::getInstance()->redirect('depto', 'index');
      } else {
        routing::getInstance()->redirect('depto', 'index');
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

