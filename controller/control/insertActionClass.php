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
class insertActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
         if(session::getInstance()->hasAttribute('form_' . controlTableClass::getNameTable())){
                $this->control = session::getInstance()->getAttribute('form_' . controlTableClass::getNameTable());
                
            }
            /* fields para foraneas*/
            $fields = array(
            empleadoTableClass::ID,
            empleadoTableClass::NOMBRE
            );
            $orderBy = array(
           empleadoTableClass::NOMBRE
            );
            $this->objEmpleado = empleadoTableClass::getAll($fields, true , $orderBy,'ASC');
            
    
      $this->defineView('insert', 'control', session::getInstance()->getFormatOutput());
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}