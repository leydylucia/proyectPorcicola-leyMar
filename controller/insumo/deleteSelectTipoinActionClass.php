<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
  Description of deleterSelectTipoInActionClass esta clase sirve para eliminar datos en masa
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 *  @category modulo insumo
 */
class deleteSelectTipoinActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {/* se grago el and resquest etc.. */
            if (request::getInstance()->isMethod('POST') and request::getInstance()->hasPost('chk')) {
                /* @var $idsToDelete  es para borrar id masivo con el checlist"chk" */
                $idsToDelete = request::getInstance()->getPost('chk');

                foreach ($idsToDelete as $id) {
                    $ids = array(
                        tipoInsumoTableClass::ID => $id
                    );
                    tipoInsumoTableClass::delete($ids, true);
                }
                /* session para  mensaje */
                session::getInstance()->setSuccess('los Elementos seleccionas fueron eliminados con exito');
                //  session::getInstance()->setSucces('los Elementos seleccionas fueron eliminados con exito');

                routing::getInstance()->redirect('insumo', 'indexTipoin');
            } else {
                routing::getInstance()->redirect('insumo', 'indexTipoin');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
