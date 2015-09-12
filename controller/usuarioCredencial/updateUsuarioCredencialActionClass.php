<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 * @category modulo usuarioCredencial
 * @author leydy lucia castillo
 * 
 */
class updateUsuarioCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::ID, true));
                $usuario = trim(request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)));
                $credencial = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true));


//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento); /* @validate para inicializar varivles para validar */
                $ids = array(
                    usuarioCredencialTableClass::ID => $id
                );

                $data = array(
                    usuarioCredencialTableClass::USUARIO_ID => $usuario,
                    usuarioCredencialTableClass::CREDENCIAL_ID => $credencial,
                );

                usuarioCredencialTableClass::update($ids, $data);
                session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
                routing::getInstance()->redirect('usuarioCredencial', 'indexUsuarioCredencial');
            } else {
                
                routing::getInstance()->redirect('usuarioCredencial', 'indexUsuarioCredencial');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->forward('usuarioCredencial', 'editUsuarioCredencial');
            session::getInstance()->setFlash('exc', $exc);
        }
    }

    

}
