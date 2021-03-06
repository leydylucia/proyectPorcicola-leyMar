<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
  Description of insertInsumoActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de insertar datos
 * 
 * @author leydy lucia castillo
 * * @category sacrificio venta
 */
class insertSacrificioVentaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      if (session::getInstance()->hasAttribute('form_' . sacrificiovTableClass::getNameTable())) {
        $this->sacrificioVenta = session::getInstance()->getAttribute('form_' . sacrificiovTableClass::getNameTable());
      }
      /* fields para foraneas */
      $fields = array(
          tipovTableClass::ID,
          tipovTableClass::DESC_TIPOV
      );
      $orderBy = array(
          tipovTableClass::DESC_TIPOV
      );
      $this->objTipoV = tipovTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fieldsCerdo = array(/* foranea cerdo"hoja de vida" */
          hojaVidaTableClass::ID,
          hojaVidaTableClass::NOMBRE_CERDO,
      );
      $orderByCerdo = array(
          hojaVidaTableClass::NOMBRE_CERDO
      );
      $this->objHojaVida = hojaVidaTableClass::getAll($fieldsCerdo, true, $orderByCerdo, 'ASC');

      $fieldsUnidad = array(
          unidadMedidaTableClass::ID,
          unidadMedidaTableClass::DESCRIPCION
      );
      $orderByUnidad = array(
          unidadMedidaTableClass::DESCRIPCION
      );
      $this->objUnidadMedida = unidadMedidaTableClass::getAll($fieldsUnidad, true, $orderByUnidad, 'ASC');


      $this->defineView('insert', 'sacrificioVenta', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
