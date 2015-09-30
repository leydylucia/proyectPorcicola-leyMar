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
 * @var $this->objInsumo para pasar variable a la vista
 * @author alexandra marcela florez
 * @category modulo detalle
 */
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('form_' . detalleEntradaTableClass::getNameTable())) {
        $this->detalle = session::getInstance()->getAttribute('form_' . detalleEntradaTableClass::getNameTable());
      }
      //estos campo son para llamar las foraneas
      $fields = array(/* foranea salidaBodega */
          entradaTableClass::ID,
      );
      $orderBy = array(
          entradaTableClass::ID,
      );
      $this->objEntrada = entradaTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fieldsInsumo = array(/* foranea insumo */
          insumoTableClass::ID,
          insumoTableClass::DESC_INSUMO
      );
      $orderByInsumo = array(
          insumoTableClass::DESC_INSUMO
      );
      $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');

      $fieldsUnidad = array(
          unidadMedidaTableClass::ID,
          unidadMedidaTableClass::DESCRIPCION
      );
      $orderByUnidad = array(
          unidadMedidaTableClass::DESCRIPCION
      );
      $this->objUnidadMedida = unidadMedidaTableClass::getAll($fieldsUnidad, true, $orderByUnidad, 'ASC');




      $this->id_entrada_bodega = request::getInstance()->getGet(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true)); /* manda el id a la vista */
      $this->defineView('insert', 'detalle', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
