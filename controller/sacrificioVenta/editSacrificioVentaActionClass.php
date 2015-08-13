<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of ejemploClass
 *
 * @author leydy lucia castillo moaquera
 * * @category sacrificio venta
 */
class editSacrificioVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasGet(sacrificiovTableClass::ID)) {
                $fields = array(
                    sacrificiovTableClass::ID,
                    sacrificiovTableClass::VALOR,
                    sacrificiovTableClass::TIPO_VENTA_ID,
                    sacrificiovTableClass::ID_CERDO,
                    sacrificiovTableClass::CANTIDAD,
                    sacrificiovTableClass::UNIDAD_MEDIDA_ID,
                );
                $where = array(
                    sacrificiovTableClass::ID => request::getInstance()->getGet(sacrificiovTableClass::ID)
                );
                $this->objSacrificioV = sacrificiovTableClass::getAll($fields, true, null, null, null, null, $where);


                //estos campo son para llamar las foraneas
                $fieldsa = array(
                    tipovTableClass::ID,
                    tipovTableClass::DESC_TIPOV
                );
                $orderBy = array(
                    tipovTableClass::DESC_TIPOV
                );
                $this->objTipoV = tipovTableClass::getAll($fieldsa, true, $orderBy, 'ASC');

                $fieldsCerdo = array(/* foranea cerdo"hoja de vida" */
                    hojaVidaTableClass::ID,
                    hojaVidaTableClass::NOMBRE_CERDO,
                );
                $orderByCerdo = array(
                    hojaVidaTableClass::NOMBRE_CERDO
                );
                $this->objHojaVida = hojaVidaTableClass::getAll($fieldsCerdo, true, $orderByCerdo, 'ASC');

                $fieldsUnidad = array(
                    unidadMedidaTableClass::ID,
                    unidadMedidaTableClass::DESCRIPCION
                );
                $orderByUnidad = array(
                    unidadMedidaTableClass::DESCRIPCION
                );
                $this->objUnidadMedida = unidadMedidaTableClass::getAll($fieldsUnidad, true, $orderByUnidad, 'ASC');



                $this->defineView('edit', 'sacrificioVenta', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */

                log::register('editar', sacrificiovTableClass::getNameTable()); //linea de bitacora
            } else {
                routing::getInstance()->redirect('sacrificioVenta', 'indexSacrificioVenta');
                session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
            }
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}

//echo '$ ' . number_format($precio, 0, ',', '.');
