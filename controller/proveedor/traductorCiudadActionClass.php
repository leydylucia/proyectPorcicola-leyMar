<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class traductorCiudadActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') === true) {
        $language = request::getInstance()->getPost('language');
        $PATH_INFO = request::getInstance()->getServer('PATH_INFO');
        session::getInstance()->setDefaultCulture($language);
        $dir = config::getUrlBase() . config::getIndexFile() . $PATH_INFO;
        header('location: ' . $dir);
      } else {
        routing::getInstance()->redirect('proveedor', 'indexCiudad');
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
