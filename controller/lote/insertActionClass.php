<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of insertActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de insertar datos
 *
 * @author Alexandra Florez
 * @category modulo lote
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('form_' . loteTableClass::getNameTable())) {
        $this->lote = session::getInstance()->getAttribute('form_' . loteTableClass::getNameTable());
      }

      $this->defineView('insert', 'lote', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
