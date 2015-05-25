<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author leydy lucia castillo mosquera
 * * @category sacrificio venta
 */
class deleteSelectSacrificioVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {/* se grago el and resquest etc.. */
            if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {



                $idsToDelete = request::getInstance()->getPost('chk');


                foreach ($idsToDelete as $id) {
                    $ids = array(
                        sacrificiovTableClass::ID => $id
                    );
                    sacrificiovTableClass::delete($ids, true);
                }
                /* session para  mensaje */
                session::getInstance()->setSuccess('los Elementos seleccionas fueron eliminados con exito');
//        session::getInstance()->setSucces();


                routing::getInstance()->redirect('sacrificioVenta', 'indexSacrificioVenta');
            } else {
                routing::getInstance()->redirect('sacrificioVenta', 'indexSacrificioVenta');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
