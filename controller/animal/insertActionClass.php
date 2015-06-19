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
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('form_' . hojaVidaTableClass::getNameTable())) {
        $this->hojaVida = session::getInstance()->getAttribute('form_' . hojaVidaTableClass::getNameTable());
      }
      // para editar foraneas tabla estado
      $fields = array(
          estadoTableClass::ID,
          estadoTableClass::DESC_ESTADO
      );
      $orderBy = array(
          estadoTableClass::DESC_ESTADO
      );
      $this->objEstado = estadoTableClass::getAll($fields, true, $orderBy, 'ASC');
      //fin
      // para editar foraneas tabla lote
      $fields = array(
          loteTableClass::ID,
          loteTableClass::DESC_LOTE
      );
      $orderBy = array(
          loteTableClass::DESC_LOTE
      );
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
      //fin
      // para editar foraneas tabla raza
      $fields = array(
          razaTableClass::ID,
          razaTableClass::DESC_RAZA
      );
      $orderBy = array(
          razaTableClass::DESC_RAZA
      );
      $this->objRaza = razaTableClass::getAll($fields, true, $orderBy, 'ASC');
      //fin

      $this->defineView('insert', 'animal', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
