<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

use hook\log\logHookClass as log;/*linea de la bitacora*/

/**
 * Description of ejemploClass
 *
 * @author leydy lucia castillo moaquera
 *  @category modulo insumo
 * 
 */
class editSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasGet(salidaBodegaTableClass::ID)) {
                $fields = array(
                    salidaBodegaTableClass::ID,
                    salidaBodegaTableClass::EMPLEADO_ID
                );
                $where = array(
                    salidaBodegaTableClass::ID => request::getInstance()->getGet(salidaBodegaTableClass::ID)
                );
                $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, true, null, null, null, null, $where);

                //estos campo son para llamar las foraneas
                $fields = array(/* foranea de usuario */
                    empleadoTableClass::ID,
                    empleadoTableClass::NOMBRE
                );
                $orderBy = array(
                    empleadoTableClass::NOMBRE
                );
                $this->objEmpleado = empleadoTableClass::getAll($fields, true, $orderBy, 'ASC'); /* @param fields , para campos */


                $this->defineView('editSalidaBodega', 'salidaBodega', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */


                 log::register('editar',  salidaBodegaTableClass::getNameTable());//linea de bitacora
            } else {
                routing::getInstance()->redirect('salidaBodega', 'indexSalidaBodega');
                session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
            }
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}

//echo '$ ' . number_format($precio, 0, ',', '.');
