<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of ejemploClass
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category sacrificio venta
 */
class createSacrificioventaActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variables 
     * @var $valor=> valor
     * @var $tipoVenta=> tipo venta
     * @var $idCerdo=> id cerdo
     
     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $valor = trim(request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true)));
                $tipoVenta = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::TIPO_VENTA_ID, true));
                $idCerdo = request::getInstance()->getPost(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true));


                $this->Validate($valor,$idCerdo);/*@ $this->validate para validar campos*/

                /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
                $data = array(
                    sacrificiovTableClass::VALOR => $valor,
                    sacrificiovTableClass::TIPO_VENTA_ID => $tipoVenta,
                    sacrificiovTableClass::ID_CERDO => $idCerdo
                );
                sacrificiovTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
                // log::register('insertar', insumoTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('sacrificioVenta', 'indexSacrificioVenta');
            } else {
                routing::getInstance()->redirect('sacrificioVenta', 'indexSacrificioVenta');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->redirect('sacrificioVenta', 'insertSacrificioVenta');
            session::getInstance()->setFlash('exc', $exc);
            //routing::getInstance()->forward('shfSecurity', 'exception');    
        }
    }
/* @ function para validar campos de formulario*/
    static public function Validate($valor,$idCerdo) {
        $flag = false;
        
        if (!is_numeric($valor)) {//validacion de numeros
            session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true), true);
        }


        if ($valor === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::VALOR, true), true);
        }
        if ($idCerdo === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(sacrificiovTableClass::getNameField(sacrificiovTableClass::ID_CERDO, true), true);
        }
       



        if ($flag === true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('sacrificioVenta', 'insertSacrificioVenta');
        }
    }
}
