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
 *@category modulo sacrificio venta
 *@author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class updateTipovActionClass extends controllerClass implements controllerActionInterface {
      /* public function execute inicializa las variable 
     * @var $desc_tipoV=> descripcion tipo venta

     * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(tipovTableClass::getNameField(tipovTableClass::ID, true));
        $desc_tipoV= request::getInstance()->getPost(tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true));
       
         $this->Validate($desc_tipoV);
        
        $ids = array(
        tipovTableClass::ID => $id
        );

        $data = array(
        tipovTableClass::DESC_TIPOV => $desc_tipoV,
           
        );

       tipovTableClass::update($ids, $data);
      }

      routing::getInstance()->redirect('sacrificioVenta', 'indexTipov');
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
    }
  }
  private function Validate($desc_tipoV) {
        $flag = false;
        if (strlen($desc_tipoV) > tipovTableClass::DESC_TIPOV_LENGTH) {
            session::getInstance()->setError(i18n::__('errorLength', null, 'default', array('%insumo%' => $desc_tipoV, '%caracteres%' => tipovTableClass::DESC_TIPOV_LENGTH)));
            $flag = true;
            session::getInstance()->setFlash(tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true), true);
        }

        if (!ereg("^[A-Z a-z_]*$", $desc_tipoV)) {
            session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $desc_tipoV)));
            $flag = true;
            session::getInstance()->setFlash(tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, TRUE), TRUE);
        }

       
        if ($desc_tipoV === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true), true);
        }

       


        if ($flag === true) {
            request::getInstance()->setMethod('GET');
            request::getInstance()->addParamGet(array(tipovTableClass::ID => request::getInstance()->getPost(tipovTableClass::getNameField(tipovTableClass::ID, true))));
            routing::getInstance()->forward('sacrificioVenta', 'editTipov');
        }
    }
}
