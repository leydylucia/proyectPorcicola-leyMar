<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log;

/**
 * Description of deleteCiudadActionClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo proveedor
 */
class deleteProvActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $id=> identificacion de la ciudad (bigInt)
   * @return $ids=> declara con cual id va a borras
   * @return $this=> es el que lleva los datos a la vista
   * Todas estos datos se pasan en la variable @var $data 
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, true));

        $ids = array(
            proveedorTableClass::ID => $id
        );
        proveedorTableClass::delete($ids, true); /* el true es para el borrado logico false si no lo tiene */
        //routing::getInstance()->redirect('parto', 'index');

        /** @var $this->arrayAjax pasa los datos a la vista, es de tipo Ajax* */
        $this->arrayAjax = array(
            'code' => 200,
            'msg' => 'la eliminacion fue exitosa'
        );
        $this->defineView('deleteProv', 'proveedor', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('Registro Exitoso');

//        log::register('eliminar', proveedorTableClass::getNameTable()); 
      } else {
        routing::getInstance()->redirect('proveedor', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
