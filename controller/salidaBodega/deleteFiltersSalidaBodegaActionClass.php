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
 *
  @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo usuarioCredencial
 * @class deleteFiltersUsuarioCredencialActionClass=>para borrar filtros
 */
class deleteFiltersSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                session::getInstance()->deleteAttribute('defaultIndexFilters');
            }
            routing::getInstance()->redirect('salidaBodega', 'indexSalidaBodega');
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
