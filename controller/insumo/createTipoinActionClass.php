<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\tipoInsumoValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

use hook\log\logHookClass as log;/*linea de la bitacora*/
/**
 *  Description of createActionClass esta clase sirve para 
 *  el create carge datos de la tabla y cumple con la funcion de insertar
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * * @category modulo insumo
 */
class createTipoinActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variable 
     * @return $desc_tipoIn=> descripcion tipo insumo(varchar)
     *  este dato se pasa en la varible @var $data

     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $desc_tipoIn = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true));



//                $this->Validate($desc_tipoIn);/*@ $this->validate para validar campos*/
                validator::validateInsert();

                /** @return $data recorre el campo  o campos seleccionados de la tabla deseada* */
                $data = array(
                    tipoInsumoTableClass::DESC_TIPOIN => $desc_tipoIn
                );
                tipoInsumoTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
                 log::register('insertar', tipoInsumoTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('insumo', 'indexTipoin');
            } else {
                routing::getInstance()->redirect('insumo', 'indexTipoin');
            }
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

    /* @ function para validar campos de formulario */
//        private function Validate($desc_tipoIn) {
//        $flag = false;
//        if (strlen($desc_tipoIn) > tipoInsumoTableClass::DESC_TIPOIN_LENGTH) {
//            session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => tipoInsumoTableClass::DESC_TIPOIN_LENGTH)));
//            $flag = true;
//            session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, TRUE), TRUE);
//        }
//
//        if (!ereg("^[A-Z a-z_]*$", $desc_tipoIn)) {/*validacion de letras o string*/
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
//            routing::getInstance()->forward('insumo', 'insertTipoin');
//        }
//    }
}
