<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insertInsumoActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de insertar datos
 * @category modulo insumo
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class insertTipoinActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $this->defineView('insertTipoin', 'insumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
