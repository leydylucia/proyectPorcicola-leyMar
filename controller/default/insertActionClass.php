<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
//use mvc\config\myConfigClass as config;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insertActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de insertar datos
 * @category moudulo default "usuario"
 * @author leydy lucia castillo
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $this->defineView('insert', 'default', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
