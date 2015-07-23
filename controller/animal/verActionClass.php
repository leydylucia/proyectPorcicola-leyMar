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
class verActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          hojaVidaTableClass::ID,
          hojaVidaTableClass::GENERO,
          hojaVidaTableClass::FECHA_NACIMIENTO,
          hojaVidaTableClass::ESTADO_ID,
          hojaVidaTableClass::LOTE_ID,
          hojaVidaTableClass::RAZA_ID,
          hojaVidaTableClass::ID_MADRE,
          hojaVidaTableClass::CREATED_AT
      );
      $where = array(
          hojaVidaTableClass::ID => request::getInstance()->getRequest(hojaVidaTableClass::ID)
      );
      $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, null, null, null, nULL, $where);
      $this->defineView('ver', 'animal', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
