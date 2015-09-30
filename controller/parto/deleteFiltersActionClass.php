<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 *  Description este es la funcion que hace el boton eliminar filtros es decir 
 * limpiar el campo despues de hacer un filtro o consulta
 *
  @author Alexandra Florez
 * @category parto
 */
class deleteFiltersActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('defaultIndexFilters')) {
        session::getInstance()->deleteAttribute('defaultIndexFilters');
      }
      routing::getInstance()->redirect('parto', 'index');
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
