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
 * @category modulo usuarioCredencial
 * @author leydy lucia castillo
 * 
 */
class updateSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $id = request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, true));
                $empleado = trim(request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO_ID, true)));



//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento); /* @validate para inicializar varivles para validar */
                $ids = array(
                    salidaBodegaTableClass::ID => $id
                );

                $data = array(
                    salidaBodegaTableClass::EMPLEADO_ID => $empleado,
                );

                salidaBodegaTableClass::update($ids, $data);
                routing::getInstance()->redirect('salidaBodega', 'editSalidaBodega');
            } else {
                session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
                routing::getInstance()->redirect('salidaBodega', 'editSalidaBodega');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->forward('salidaBodega', 'editSalidaBodega');
            session::getInstance()->setFlash('exc', $exc);
        }
    }

}
