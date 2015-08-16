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
class editEnActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet(entradaTableClass::ID)) {
        $fields = array(
            entradaTableClass::ID,
            entradaTableClass::EMPLEADO_ID,
            entradaTableClass::PROVEEDOR_ID
        );

        $where = array(
            entradaTableClass::ID => request::getInstance()->getGet(entradaTableClass::ID)
        );
        $this->objEntrada = entradaTableClass::getAll($fields, true, null, null, null, null, $where);
        // para editar foraneas
        $fields = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE,
            empleadoTableClass::APELLIDO
        );
        $orderBy = array(
            empleadoTableClass::NOMBRE
        );
        $this->objEmpleado = empleadoTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        // para editar foraneas
        $fields = array(
            proveedorTableClass::ID,
            proveedorTableClass::NOMBRE,
            proveedorTableClass::APELLIDO
        );
        $orderBy = array(
            proveedorTableClass::NOMBRE
        );
        $this->objProveedor = proveedorTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        $this->defineView('edit', 'entrada', session::getInstance()->getFormatOutput());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('entrada', 'indexEn');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
