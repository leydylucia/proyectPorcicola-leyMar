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
 * @category moudulo vacunacion
 * @author leydy lucia castillo
 */
class insertVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (session::getInstance()->hasAttribute('form_' . vacunacionTableClass::getNameTable())) {
                $this->vacunacion = session::getInstance()->getAttribute('form_' . vacunacionTableClass::getNameTable());
            }
            /* fields para foraneas */
            //estos campo son para llamar las foraneas
            $fieldsInsumo = array(/* foranea de  insumo */
                insumoTableClass::ID,
                insumoTableClass::DESC_INSUMO
            );
            $orderByInsumo = array(
                insumoTableClass::DESC_INSUMO
            );
            $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');


            $fieldsCerdo = array(/* foranea cerdo"hoja de vida" */
                hojaVidaTableClass::ID,
            );
            $orderByCerdo = array(
                hojaVidaTableClass::ID
            );
            $this->objHojaVida = hojaVidaTableClass::getAll($fieldsCerdo, true, $orderByCerdo, 'ASC');



            $this->defineView('insert', 'vacunacion', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
