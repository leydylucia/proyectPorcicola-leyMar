<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class insertActionClass  extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
         if(session::getInstance()->hasAttribute('form_' . empleadoTableClass::getNameTable())){
                $this->empleado = session::getInstance()->getAttribute('form_' . empleadoTableClass::getNameTable());
                
            }
            // para editar foraneas
        $fields = array(
            usuarioTableClass::ID,
            usuarioTableClass::USER
        );
        $orderBy = array(
            usuarioTableClass::USER
        );
        $this->objUsuario = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC');
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
        
            
    
      $this->defineView('insert', 'empleado', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}