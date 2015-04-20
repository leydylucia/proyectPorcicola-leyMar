<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log;/*linea de la bitacora*/
/**
 * Description of ejemploClass
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class createTipoinActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variable 
     * @var $desc_tipoIn=> descripcion tipo insumo

     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $desc_tipoIn = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true));

//validaciones
                //caracteres especiales
                if (ereg("^{a-zA-Z0-9}{3,20}$", $desc_tipoIn) == true) {
                    throw new PDOException(i18n::__(10002, null, 'errors')); //falta poner en diccionario el error adecuado
                }
                //caracteres especiales
                if (strlen($desc_tipoIn) > tipoInsumoTableClass::DESC_TIPOIN_LENGTH) {
                    throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => tipoInsumoTableClass::DESC_TIPOIN_LENGTH)), 00001);
                }


                $this->Validate($desc_tipoIn);
                /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
                $data = array(
                    tipoInsumoTableClass::DESC_TIPOIN => $desc_tipoIn
                );
                tipoInsumoTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
                // log::register('insertar', tipoInsumoTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('insumo', 'indexTipoin');
            } else {
                routing::getInstance()->redirect('insumo', 'indexTipoin');
            }
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }
        private function Validate($desc_tipoIn) {
        $flag = false;
        if (strlen($desc_tipoIn) > tipoInsumoTableClass::DESC_TIPOIN_LENGTH) {
            session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => tipoInsumoTableClass::DESC_TIPOIN_LENGTH)));
            $flag = true;
            session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, TRUE), TRUE);
        }

        if (!ereg("^[A-Z a-z_]*$", $desc_tipoIn)) {
            session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $desc_tipoIn)));
            $flag = true;
            session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, TRUE), TRUE);
        }


        if ($desc_tipoIn === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true), true);
        }





        if ($flag === true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('insumo', 'insertTipoin');
        }
    }

}
