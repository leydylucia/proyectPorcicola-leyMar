<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\vacunacionValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of ejemploClass
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo vacunacion
 */
class createVacunacionActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variables 
     * @var $dosis=> dosis
     * @var $hora=> hora
     * @var $insumoId=> insumo_id
     * @var $idCerdo=> id_cerdo
     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $dosis = trim(request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true)));
                $hora = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true));
                $insumoId = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::INSUMO_ID, true));
                $idCerdo = request::getInstance()->getPost(vacunacionTableClass::getNameField(vacunacionTableClass::ID_CERDO, true));


//                $this->Validate($dosis, $hora,$insumoId); /* @ $this->validate para validar campos */
                validator::validateInsert();
                /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
                $data = array(
                    vacunacionTableClass::DOSIS => $dosis,
                    vacunacionTableClass::HORA => $hora,
                    vacunacionTableClass::INSUMO_ID => $insumoId,
                    vacunacionTableClass::ID_CERDO => $idCerdo,
                );
                vacunacionTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
                 log::register('insertar', vacunacionTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            } else {
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->redirect('vacunacion', 'insertvacunacion');
            session::getInstance()->setFlash('exc', $exc);
            //routing::getInstance()->forward('shfSecurity', 'exception');    
        }
    }

    /* @ function para validar campos de formulario */

//    private function Validate($dosis, $hora, $insumoId) {
//        $flag = false;
//        if (strlen($dosis) > vacunacionTableClass::DOSIS_LENGTH) {
//            session::getInstance()->setError(i18n::__('errorLength', null, 'default', array('%insumo%' => $dosis, '%caracteres%' => vacunacionTableClass::DOSIS_LENGTH)));
//            $flag = true;
//            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true), true);
//        }
//
//
//
//
//        if ($dosis === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::DOSIS, true), true);
//        }
//
//        if ($hora === '') {// validacion de campo vacio
//            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//            $flag = true;
//            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::HORA, true), true);
//        }
//
////        if ($insumoId === '') {// validacion de campo vacio
////            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
////            $flag = true;
////            session::getInstance()->setFlash(vacunacionTableClass::getNameField(vacunacionTableClass::INSUMO_ID, true), true);
////        }
//
//
//        if ($flag === true) {
//            request::getInstance()->setMethod('GET');
//            routing::getInstance()->forward('vacunacion', 'insertVacunacion');
//        }
//    }

}
