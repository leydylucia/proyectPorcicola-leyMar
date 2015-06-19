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
 * @author Alexandra Florez
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet(hojaVidaTableClass::ID)) {
        $fields = array(
            hojaVidaTableClass::ID,
            hojaVidaTableClass::GENERO,
            hojaVidaTableClass::FECHA_NACIMIENTO,
            hojaVidaTableClass::ESTADO_ID,
            hojaVidaTableClass::LOTE_ID,
            hojaVidaTableClass::RAZA_ID,
            hojaVidaTableClass::ID_MADRE
        );

        $where = array(
            hojaVidaTableClass::ID => request::getInstance()->getGet(hojaVidaTableClass::ID)
        );
        $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, null, null, null, null, $where);
        
        // para editar foraneas tabla estado
        $fields = array(
            estadoTableClass::ID,
            estadoTableClass::DESC_ESTADO
        );
        $orderBy = array(
            estadoTableClass::DESC_ESTADO
        );
        $this->objEstado = estadoTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        
        // para editar foraneas tabla lote
        $fields = array(
            loteTableClass::ID,
            loteTableClass::DESC_LOTE
        );
        $orderBy = array(
            loteTableClass::DESC_LOTE
        );
        $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        
        // para editar foraneas tabla raza
        $fields = array(
            razaTableClass::ID,
            razaTableClass::DESC_RAZA
        );
        $orderBy = array(
            razaTableClass::DESC_RAZA
        );
        $this->objRaza = razaTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        
        $this->defineView('edit', 'animal', session::getInstance()->getFormatOutput());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
      } else {
        routing::getInstance()->redirect('animal', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}