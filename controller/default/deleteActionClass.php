<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
//use mvc\config\myConfigClass as config;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\session\sessionClass as session;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log; /* linea de la bitacora */

/**
  Description of deleteActionClass esta clase sirve para eliminar datos individuales
 *
 * @author leydy lucia castillo mosquera
 * * @category modulo default "usuario"
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {
    /*     * @var $ids=> declara con que va a borrar
     * @var  $this->arrayAjax que el dato que va a la vista es de tipo ajax* */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST') and request::getInstance()->isAjaxRequest()) {

                $id = request::getInstance()->getPost(usuarioTableClass::getNameField(usuarioTableClass::ID, true));

                $ids = array(
                    usuarioTableClass::ID => $id
                );
                usuarioTableClass::delete($ids, true); /* el true es para el borrado logico false si no lo tiene */
                //routing::getInstance()->redirect('depto', 'index');
                $this->arrayAjax = array(
                    'code' => 200,
                    'msg' => 'la eliminacion fue exitosa'
                );
                $this->defineView('delete', 'default', session::getInstance()->getFormatOutput());
                session::getInstance()->setSuccess('el registro se elimino con exito'); /* mensaje de exito */
                log::register('eliminar',  usuarioTableClass::getNameTable());//linea de bitacora
            } else {
                routing::getInstance()->redirect('default', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
