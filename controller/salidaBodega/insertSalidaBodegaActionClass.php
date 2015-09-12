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
 * @var $this->objInsumo para pasar variable a la vista
 * @category moudulo usuarioCredencial
 * @author leydy lucia castillo
 */
class insertSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {

            if (session::getInstance()->hasAttribute('form_' . salidaBodegaTableClass::getNameTable())) {
                $this->salidaBodega = session::getInstance()->getAttribute('form_' . salidaBodegaTableClass::getNameTable());
            }
            //estos campo son para llamar las foraneas
            $fields = array(/* foranea empleados */
                empleadoTableClass::ID,
                empleadoTableClass::NOMBRE,
                empleadoTableClass::APELLIDO
            );
            $orderBy = array(
                empleadoTableClass::NOMBRE
            );
            $this->objEmpleado = empleadoTableClass::getAll($fields, true, $orderBy, 'ASC');




            $this->defineView('insertSalidaBodega', 'salidaBodega', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
