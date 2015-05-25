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
class insertDetalleActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('form_' . detalleEntradaTableClass::getNameTable())) {
        $this->detalle = session::getInstance()->getAttribute('form_' . detalleEntradaTableClass::getNameTable());
      }
      /* fields para foraneas */
      $fields = array(
          entradaTableClass::ID
      );
      $orderBy = array(
          entradaTableClass::ID
      );
      $this->objEntrada = entradaTableClass::getAll($fields, true, $orderBy, 'ASC');

      /* fields para foraneas */
      $fieldsA = array(
          loteTableClass::ID,
          loteTableClass::DESC_LOTE
      );
      $orderByA = array(
          loteTableClass::DESC_LOTE
      );
      $this->objLote = loteTableClass::getAll($fieldsA, true, $orderByA, 'ASC');

      /* fields para foraneas */
      $fieldsT = array(
          insumoTableClass::ID,
          insumoTableClass::DESC_INSUMO
      );
      $orderByT = array(
          insumoTableClass::DESC_INSUMO
      );
      $this->objInsumo = insumoTableClass::getAll($fieldsT, true, $orderByT, 'ASC');


      $this->defineView('insertDetalle', 'entrada', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
