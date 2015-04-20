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
class updateDeptoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(deptoTableClass::getNameField(deptoTableClass::ID, true));
        $nomDepto = request::getInstance()->getPost(deptoTableClass::getNameField(deptoTableClass::NOM_DEPTO, true));

        $ids = array(
            deptoTableClass::ID => $id
        );

        $data = array(
            deptoTableClass::NOM_DEPTO => $nomDepto
        );

        deptoTableClass::update($ids, $data);
      }

      routing::getInstance()->redirect('depto', 'indexDepto');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
