<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\session\sessionClass as session;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author leydy lucia castillo
 */
class deleteActionClass extends controllerClass implements controllerActionInterface {
    
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
                // log::register('eliminar',  insumoTableClass::getNameTable());//linea de bitacora
            } else {
                routing::getInstance()->redirect('default', 'index');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }


}
