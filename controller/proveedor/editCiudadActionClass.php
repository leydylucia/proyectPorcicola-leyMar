<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of editCiudadClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo proveedor
 */

class editCiudadActionClass extends controllerClass implements controllerActionInterface {
  
  /* public function execute inicializa las variables 
     * @return $fields=> son los campos que trae de la base de datos
     * @return $this=> es el que lleva los datos a la vista
     * @return $where=>
     * @return $orderBy=> es para dar orden ascendente o descendente de los datos que provienen de la base de datos
     * Todas estos datos se pasan en la variable @var $data 
     * ** */

  public function execute() {
    try {
      if (request::getInstance()->hasGet(ciudadTableClass::ID)) {
        $fields = array(
            ciudadTableClass::ID,
            ciudadTableClass::NOM_CIUDAD,
            ciudadTableClass::DEPTO_ID
        );
        $where = array(
            ciudadTableClass::ID => request::getInstance()->getGet(ciudadTableClass::ID)
        );
        $this->objCiudad = ciudadTableClass::getAll($fields, true, null, null, null, null, $where);
        //editar foraneas
        $fields = array(
            deptoTableClass::ID,
            deptoTableClass::NOM_DEPTO
        );
        $orderBy = array(
            deptoTableClass::NOM_DEPTO
        );
        $this->objDepto = deptoTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        $this->defineView('editCiudad', 'proveedor', session::getInstance()->getFormatOutput());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('proveedor', 'indexCiudad');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
