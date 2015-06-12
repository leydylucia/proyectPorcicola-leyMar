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
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 */
class insertCiudadActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
        if(session::getInstance()->hasAttribute('form_' . ciudadTableClass::getNameTable())){
                $this->ciudad = session::getInstance()->getAttribute('form_' . ciudadTableClass::getNameTable());
                
            }
            /* fields para foraneas*/
            $fields = array(
            deptoTableClass::ID,
            deptoTableClass::NOM_DEPTO
            );
            $orderBy = array(
           deptoTableClass::NOM_DEPTO
            );
            $this->objDepto = deptoTableClass::getAll($fields, true , $orderBy,'ASC');
    
      $this->defineView('insertCiudad', 'proveedor', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
