<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description esta funcion es para el eliminado individual
 *
 * @author Alexandra Florez
 * @category modulo animal
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $id=> identificacion de animal u hoja de vida (bigInt)
   * @return $ids=> declara con cual id va a borras
   * @return $this=> es el que lleva los datos a la vista
   * Todas estos datos se pasan en la variable @var $data 
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(hojaVidaTableClass::getNameField(hojaVidaTableClass::ID, true));

        $ids = array(
            hojaVidaTableClass::ID => $id
        );
        hojaVidaTableClass::delete($ids, true); /* el true es para el borrado logico false si no lo tiene */
        //routing::getInstance()->redirect('parto', 'index');
        $this->arrayAjax = array(
            'code' => 200,
            'msg' => 'la eliminacion fue exitosa'
        );
        $this->defineView('delete', 'animal', session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('Registro Exitoso');
      } else {
        routing::getInstance()->redirect('animal', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }

}
