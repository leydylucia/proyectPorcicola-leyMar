<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 Description of deleteTipoInActionClass esta clase sirve para eliminar datos individuales
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 *  @category modulo insumo
 */
class deleteTipoinActionClass extends controllerClass implements controllerActionInterface {
    /*     * @var $ids=> declara con que va a borrar
     * @var  $this->arrayAjax que el dato que va a la vista es de tipo ajax* */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

                $id = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::ID, true));

                $ids = array(
                    tipoInsumoTableClass::ID => $id
                );
                tipoInsumoTableClass::delete($ids, true); /* el true es para el borrado logico false si no lo tiene */
                //routing::getInstance()->redirect('depto', 'index');
                $this->arrayAjax = array(
                    'code' => 200,
                    'msg' => 'la eliminacion fue exitosa'
                );
                $this->defineView('deleteTipoin', 'insumo', session::getInstance()->getFormatOutput());
                session::getInstance()->setSuccess('el registro se elimino con exito'); /* mensaje de exito */
            } else {
                routing::getInstance()->redirect('insumo', 'indexTipoin');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
