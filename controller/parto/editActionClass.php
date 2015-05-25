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
      if (request::getInstance()->hasRequest(partoTableClass::ID)) {
        $fields = array(
            partoTableClass::ID,
          partoTableClass::FECHA_NACIMIENTO,
          partoTableClass::NUM_NACIDOS,
          partoTableClass::NUM_NACIDOS,
          partoTableClass::NUM_MUERTOS,
          partoTableClass::NUM_HEMBRAS,
          partoTableClass::NUM_MACHOS,
          partoTableClass::FECHA_MONTADA,
          partoTableClass::ID_PADRE,
          partoTableClass::HOJA_VIDA_ID
          
        );
        $where = array(
            partoTableClass::ID => request::getInstance()->getRequest(partoTableClass::ID)
        );
        $this->objParto = partoTableClass::getAll($fields, true, null, null, null, null, $where);
        
        // para editar foraneas tabla estado
        $fields = array(
        hojaVidaTableClass::ID
        );
        $orderBy = array(
            hojaVidaTableClass::ID
        );
        $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        
        $this->defineView('edit', 'parto', session::getInstance()->getFormatOutput());
      } else {
        routing::getInstance()->redirect('parto', 'index');
      }

    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
