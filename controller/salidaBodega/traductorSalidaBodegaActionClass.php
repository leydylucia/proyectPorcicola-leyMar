<?php

//use mvc\interfaces\controllerActionInterface;
//use mvc\controller\controllerClass;
//use mvc\config\myConfigClass as config;
//use mvc\request\requestClass as request;
//use mvc\routing\routingClass as routing;
//use mvc\session\sessionClass as session;
//use mvc\i18n\i18nClass as i18n;
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
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class traductorSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {

        try {
            if (request::getInstance()->isMethod('POST') === true) {
                $language = request::getInstance()->getPost('language');
                $PATH_INFO = request::getInstance()->getServer('PATH_INFO');
                session::getInstance()->setDefaultCulture($language);
                $dir = config::getUrlBase() . config::getIndexFile() . $PATH_INFO;
                header('location: ' . $dir);
            } else {
                routing::getInstance()->redirect('salidaBodega', 'indexSalidaBodega');
            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
