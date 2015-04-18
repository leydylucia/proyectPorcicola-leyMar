
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
 * @author leydy lucia castillo mosquera
 */
class deleteCiudadActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

        $id = request::getInstance()->getPost(ciudadTableClass::getNameField(ciudadTableClass::ID, true));
        
        $ids = array(
            ciudadTableClass::ID => $id
        );
        ciudadTableClass::delete($ids, true);/*el true es para el borrado logico false si no lo tiene*/
        //routing::getInstance()->redirect('depto', 'index');
        $this->arrayAjax=array(
           'code'=>200,
           'msg' =>'la eliminacion fue exitosa'
            
        );
        $this->defineView('deleteCiudad', 'proveedor',session::getInstance()->getFormatOutput());
        session::getInstance()->setSuccess('Eliminado con Exitoso');
      } else {
        routing::getInstance()->redirect('proveedor', 'indexCiudad');
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
