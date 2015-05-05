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
 * 
 * @author leydy lucia castillo
 */
class insertSacrificioVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (session::getInstance()->hasAttribute('form_' . sacrificiovTableClass::getNameTable())) {
                $this->sacrificioVenta = session::getInstance()->getAttribute('form_' . sacrificiovTableClass::getNameTable());
            }
            /* fields para foraneas */
            $fields = array(
                tipovTableClass::ID,
                tipovTableClass::DESC_TIPOV
            );
            $orderBy = array(
                tipovTableClass::DESC_TIPOV
            );
            $this->objTipoV = tipovTableClass::getAll($fields, true, $orderBy, 'ASC');

//            $fieldsCerdo = array(
//                hojaVidaTableClass::ID,
//                hojaVidaTableClass::ID_PESO
//            );
//            $orderByCerdo = array(
//                hojaVidaTableClass::ID_PESO
//            );
//            $this->objHojaV = hojaVidaTableClass::getAll($fieldsCerdo, true, $orderByCerdo, 'ASC');



            $this->defineView('insert', 'sacrificioVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
