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

class editActionClass extends controllerClass implements controllerActionInterface {
  
  /* public function execute inicializa las variables 
     * @return $fields=> son los campos que trae de la base de datos
     * @return $this=> es el que lleva los datos a la vista
     * @return $where=>
     * @return $orderBy=> es para dar orden ascendente o descendente de los datos que provienen de la base de datos
     * Todas estos datos se pasan en la variable @var $data 
     * ** */

  public function execute() {
    try {
      if (request::getInstance()->hasGet(empleadoTableClass::ID)) {
        $fields = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE,
            empleadoTableClass::USUARIO_ID,
            empleadoTableClass::TIPO_ID_ID,
            empleadoTableClass::APELLIDO,
            empleadoTableClass::DIRECCION,
            empleadoTableClass::CORREO,
            empleadoTableClass::TELEFONO
        );

        $where = array(
            empleadoTableClass::ID => request::getInstance()->getGet(empleadoTableClass::ID)
        );
        $this->objEmpleado = empleadoTableClass::getAll($fields, true, null, null, null, null, $where);
        
        // para editar foraneas
        $fieldsA = array(
            usuarioTableClass::ID,
            usuarioTableClass::USER
        );
        $orderByA = array(
            usuarioTableClass::USER
        );
        $this->objUsuario = usuarioTableClass::getAll($fieldsA, true, $orderByA, 'ASC');
        //fin
        
        $fields = array(
            tipoIdTableClass::ID,
            tipoIdTableClass::DESC_TIPO_ID
        );
        $orderBy = array(
            tipoIdTableClass::DESC_TIPO_ID
        );
        $this->objTipoId = tipoIdTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        
        $this->defineView('edit', 'empleado', session::getInstance()->getFormatOutput());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('empleado', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
