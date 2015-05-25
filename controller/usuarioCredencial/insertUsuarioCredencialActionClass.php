<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 * @var $this->objInsumo para pasar variable a la vista
 * @category moudulo usuarioCredencial
 * @author leydy lucia castillo
 */
class insertUsuarioCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (session::getInstance()->hasAttribute('form_' . usuarioCredencialTableClass::getNameTable())) {
                $this->usuarioCredencial = session::getInstance()->getAttribute('form_' . usuarioCredencialTableClass::getNameTable());
            }
           //estos campo son para llamar las foraneas
                $fields = array(/* foranea de usuario */
                    usuarioTableClass::ID,
                    usuarioTableClass::USER
                );
                $orderBy = array(
                    usuarioTableClass::USER
                );
                $this->objUsuario = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC');

                $fieldsCredencial = array(/* foranea credencial */
                    credencialTableClass::ID,
                    credencialTableClass::NOMBRE
                );
                $orderByCredencial = array(
                    credencialTableClass::NOMBRE
                );
                $this->objCredencial = credencialTableClass::getAll($fieldsCredencial, true, $orderByCredencial, 'ASC');



            $this->defineView('insertUsuarioCredencial', 'usuarioCredencial', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
