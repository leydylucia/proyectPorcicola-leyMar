<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
  Description of deleterSelectInsumoActionClass esta clase sirve para eliminar datos en masa
 * @class deleteSelectInsumoActionClass borrado en masa
 * @author leydy lucia castillo mosquera
 *  @category modulo insumo
 */
class deleteSelectActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {


                /* @var $idsToDelete  es para borrar id masivo con el checlist"chk" */
                $idsToDelete = request::getInstance()->getPost('chk'); /* @ $idsToDelete para el borrado en masa y chk para la seleccion */


                foreach ($idsToDelete as $id) {
                    $ids = array(
                    detalleHojaTableClass::ID => $id
                    );
                    detalleHojaTableClass::delete($ids, true);
                }
                /* session para  mensaje */
                session::getInstance()->setSuccess('los Elementos seleccionas fueron eliminados con exito');
//        session::getInstance()->setSucces();


                routing::getInstance()->redirect('detalleHoja', 'index',array(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID,true) => $id));
            } else {
                routing::getInstance()->redirect('detalleHoja', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
