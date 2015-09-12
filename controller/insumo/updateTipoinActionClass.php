<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\validator\tipoInsumoValidatorClass as validator;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
  *  Description of updateActionClass esta clase sirve para 
 *  el update carge datos de la tabla y cumple con la funcion de modificar
 *@category modulo insumo
 *@author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class updateTipoinActionClass extends controllerClass implements controllerActionInterface {
    
    /* public function execute inicializa las variable 
     * @return $desc_tipoIn=> descripcion tipo insumo(varchar)
     *  este dato se pasa en la varible @var $data**/

    public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true));
        $desc_tipoIn = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true));
       
        $ids = array(
        tipoInsumoTableClass::ID => $id
        );
        //validaciones
//         $this->Validate($desc_tipoIn);
//         
         //fin validacion
        validator::validateEdit();
        $data = array(
        tipoInsumoTableClass::DESC_TIPOIN => $desc_tipoIn,
           
        );

       tipoInsumoTableClass::update($ids, $data);
       session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
       routing::getInstance()->redirect('insumo', 'indexTipoin');
      }
      else {
                
           routing::getInstance()->redirect('insumo', 'indexTipoin');
            }
     
       
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }
/*@ funcion para validar campos*/
// private function Validate($desc_tipoIn) {
//        $flag = false;
//        if (strlen($desc_tipoIn) > tipoInsumoTableClass::DESC_TIPOIN_LENGTH) {
//            session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => tipoInsumoTableClass::DESC_TIPOIN_LENGTH)));
//            $flag = true;
//            session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, TRUE), TRUE);
//        }
//
//        if (!ereg("^[A-Z a-z_]*$", $desc_tipoIn)) {
//            session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $desc_tipoIn)));
//            $flag = true;
//            session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, TRUE), TRUE);
//        }
//
//
//        if ($desc_tipoIn === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true), true);
//        }
//
//
//
//
//
//        if ($flag === true) {
//            request::getInstance()->setMethod('GET');
//            request::getInstance()->addParamGet(array(tipoInsumoTableClass::ID => request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true))));
//            routing::getInstance()->forward('insumo', 'editTipoin');
//        }
//    }

}

