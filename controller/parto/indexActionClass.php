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
class indexActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      $fields = array(
          partoTableClass::ID,
          partoTableClass::FECHA_NACIMIENTO,
          partoTableClass::NUM_NACIDOS,
          partoTableClass::NUM_NACIDOS,
          partoTableClass::NUM_MUERTOS,
          partoTableClass::NUM_HEMBRAS,
          partoTableClass::NUM_MACHOS,
          partoTableClass::FECHA_MONTADA,
          partoTableClass::ID_PADRE,
          partoTableClass::CREATED_AT
      );
      $orderBy = array(
          partoTableClass::FECHA_NACIMIENTO,
          partoTableClass::NUM_NACIDOS,
          partoTableClass::NUM_NACIDOS,
          partoTableClass::NUM_MUERTOS,
          partoTableClass::NUM_HEMBRAS,
          partoTableClass::NUM_MACHOS,
          partoTableClass::FECHA_MONTADA,
          partoTableClass::ID_PADRE
      );
      $this->objParto = partoTableClass::getAll($fields, true, $orderBy, 'ASC');
      $this->defineView('index', 'parto', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
