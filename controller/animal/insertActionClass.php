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
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('form_' . hojaVidaTableClass::getNameTable())) {
        $this->hojaVida = session::getInstance()->getAttribute('form_' . hojaVidaTableClass::getNameTable());
      }

     
      $fieldsT = array(// para llamar las foraneas tabla genero
          generoTableClass::ID,
          generoTableClass::DESCRIPCION
      );
      $orderByT = array(
          generoTableClass::DESCRIPCION
      );
      $this->objGenero = generoTableClass::getAll($fieldsT, true, $orderByT, 'ASC');
      //fin
      
      $fields = array(// para editar foraneas tabla estado
          estadoTableClass::ID,
          estadoTableClass::DESC_ESTADO
      );
      $orderBy = array(
          estadoTableClass::DESC_ESTADO
      );
      $this->objEstado = estadoTableClass::getAll($fields, true, $orderBy, 'ASC');
      //fin
      
      $fields = array(// para editar foraneas tabla lote
          loteTableClass::ID,
          loteTableClass::DESC_LOTE
      );
      $orderBy = array(
          loteTableClass::DESC_LOTE
      );
      $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
      //fin
      
      $fields = array(// para editar foraneas tabla raza
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
       session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
