<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of deleterFilterActionClass esta clase sirve para eliminar filtros
 * 
 *
  @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo detallSalida
 */
class deleteFiltersDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (session::getInstance()->hasAttribute('defaultIndexFilters')) {
        session::getInstance()->deleteAttribute('defaultIndexFilters');
      }

      routing::getInstance()->redirect('detalleSalida', 'indexDetalleSalida', array(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true)/* se agrego el array por que esta trayendo el id de otra tabla */
          => request::getInstance()->getGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true))
//               array(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true)
//                => request::getInstance()->getGet(detalleSalidaTableClass::SALIDA_BODEGA_ID)
      ));
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
