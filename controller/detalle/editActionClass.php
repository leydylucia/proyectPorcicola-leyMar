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
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet(detalleEntradaTableClass::ID)) {
        $fields = array(
            detalleEntradaTableClass::ID,
            detalleEntradaTableClass::CANTIDAD,
            detalleEntradaTableClass::VALOR,
            detalleEntradaTableClass::ENTRADA_BODEGA_ID,
            detalleEntradaTableClass::INSUMO_ID
        );

        $where = array(
            detalleEntradaTableClass::ID => request::getInstance()->getGet(detalleEntradaTableClass::ID)
        );
        $this->objDetalle = detalleEntradaTableClass::getAll($fields, true, null, null, null, null, $where);
        // para editar foraneas
        $fields = array(
            entradaTableClass::ID,
        );
        $orderBy = array(
            entradaTableClass::ID
        );
        $this->objEntrada = entradaTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        // para editar foraneas
        $fieldsA = array(
            insumoTableClass::ID,
            insumoTableClass::DESC_INSUMO
        );
        $orderByA = array(
            insumoTableClass::DESC_INSUMO
        );
        $this->objInsumo = insumoTableClass::getAll($fieldsA, true, $orderByA, 'ASC');
        //fin
        $this->defineView('edit', 'detalle', session::getInstance()->getFormatOutput());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('detalle', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}