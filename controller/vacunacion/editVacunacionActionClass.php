<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log;/*linea de la bitacora*/

/**
 * Description of ejemploClass
 *
 * @author leydy lucia castillo moaquera
 *  @category modulo vacunacion
 */
class editVacunacionActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasGet(vacunacionTableClass::ID)) {
                $fields = array(
                    vacunacionTableClass::ID,
                    vacunacionTableClass::DOSIS,
                    vacunacionTableClass::HORA,
                    vacunacionTableClass::INSUMO_ID,
                    vacunacionTableClass::ID_CERDO,
                );
                $where = array(
                    vacunacionTableClass::ID => request::getInstance()->getGet(vacunacionTableClass::ID)
                );
                $this->objVacunacion = vacunacionTableClass::getAll($fields, true, null, null, null, null, $where);

                //estos campo son para llamar las foraneas
                $fieldsInsumo = array(/* foranea de  insumo */
                    insumoTableClass::ID,
                    insumoTableClass::DESC_INSUMO
                );
                $orderByInsumo = array(
                    insumoTableClass::DESC_INSUMO
                );
                $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');

                
                
                $fieldsCerdo = array(/* foranea cerdo hojadevida */
                    hojaVidaTableClass::ID,
                );
                $orderByCerdo = array(
                    hojaVidaTableClass::ID
                );
                $this->objHojaVida= hojaVidaTableClass::getAll($fieldsCerdo, true, $orderByCerdo, 'ASC');

                $this->defineView('edit', 'vacunacion', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */


//                 log::register('editar',  vacunacionTableClass::getNameTable());//linea de bitacora
            } else {
                routing::getInstance()->redirect('vacunacion', 'indexVacunacion');
                session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
            }
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}

//echo '$ ' . number_format($precio, 0, ',', '.');
