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
 * @var $this->objInsumo para pasar variable a la vista
 * @category moudulo insumo
 * @author leydy lucia castillo
 */
class insertInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {

      if (session::getInstance()->hasAttribute('form_' . insumoTableClass::getNameTable())) {
        $this->insumo = session::getInstance()->getAttribute('form_' . insumoTableClass::getNameTable());
      }
      /* fields para foraneas */
      $fields = array(/* foranea tipo insumo */
          tipoInsumoTableClass::ID,
          tipoInsumoTableClass::DESC_TIPOIN
      );
      $orderBy = array(
          tipoInsumoTableClass::DESC_TIPOIN
      );
      $this->objTipoin = tipoinsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

      $fieldsProveedor = array(/* foranea proveedor */
          proveedorTableClass::ID,
          proveedorTableClass::NOMBRE,
          proveedorTableClass::APELLIDO
      );
      $orderByProvedor = array(
          proveedorTableClass::NOMBRE
      );
      $this->objProv = proveedorTableClass::getAll($fieldsProveedor, true, $orderByProvedor, 'ASC');



      $this->defineView('insert', 'insumo', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
