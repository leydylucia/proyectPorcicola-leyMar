<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log;

/**
 * Description of editProvClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo credencial
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
      if (request::getInstance()->hasGet(credencialTableClass::ID)) {
        $fields = array(
            credencialTableClass::ID,
            credencialTableClass::NOMBRE
        );

        $where = array(
            credencialTableClass::ID => request::getInstance()->getGet(credencialTableClass::ID)
        );
        $this->objCredencial = credencialTableClass::getAll($fields, true, null, null, null, null, $where);
        
        $this->defineView('edit', 'credencial', session::getInstance()->getFormatOutput());
        
        log::register('editar', credencialTableClass::getNameTable());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('credencial', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
