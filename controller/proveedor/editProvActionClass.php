<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;


/**
 * Description of editProvClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo proveedor
 **/

class editProvActionClass extends controllerClass implements controllerActionInterface {

  /* public function execute inicializa las variables 
     * @return $fields=> son los campos que trae de la base de datos
     * @return $this=> es el que lleva los datos a la vista
     * @return $where=>
     * @return $orderBy=> es para dar orden ascendente o descendente de los datos que provienen de la base de datos
     * Todas estos datos se pasan en la variable @var $data 
     * ** */
  
  public function execute() {
    try {
      if (request::getInstance()->hasGet(proveedorTableClass::ID)) {
        $fields = array(
            proveedorTableClass::ID,
            proveedorTableClass::NOMBRE,
            proveedorTableClass::APELLIDO,
            proveedorTableClass::DIRECCION,
            proveedorTableClass::CORREO,
            proveedorTableClass::TELEFONO,
            proveedorTableClass::CIUDAD_ID
        );

        $where = array(
            proveedorTableClass::ID => request::getInstance()->getGet(proveedorTableClass::ID)
        );
        $this->objProveedor = proveedorTableClass::getAll($fields, true, null, null, null, null, $where);
        
        // para editar foraneas
        $fields = array(
            ciudadTableClass::ID,
            ciudadTableClass::NOM_CIUDAD
        );
        $orderBy = array(
            ciudadTableClass::NOM_CIUDAD
        );
        $this->objCiudad = ciudadTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        $this->defineView('edit', 'proveedor', session::getInstance()->getFormatOutput());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('proveedor', 'indexProv');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
