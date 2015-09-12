<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\detalleHojaValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

/**
 *  Description of updateActionClass esta clase sirve para 
 *  el update carge datos de la tabla y cumple con la funcion de modificar
 * @category modulo insumo
 * @author leydy lucia castillo
 * 
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {
                /* public function execute inicializa las variables 
                 * @return $desc_insumo=> descripcion insumo (string)
                 * @return $precio=> precio (numerico)
                 * @return $tipoInsumo=> id tipo insumo (bigint)
                 * @return $fechaFabricacion=> fecha fabricacion(date)
                 * @return $fechaVencimiento=> fecha vencimiento(date)
                 * @return $proveedorId =>id del proveedor (bigint)
                 * todas estos datos se pasa en la varible @var $data
                 * ** */

                $id = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::ID, true));
                $peso_cerdo = trim(request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::PESO_CERDO, true)));
                $unidad_medida = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::UNIDAD_MEDIDA_ID, true));
                $id_hoja_vida = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, TRUE));
                $insumo = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::INSUMO_ID, true));
                $dosis = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::DOSIS, true));
                $tipo_insumo = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::TIPO_INSUMO_ID, true));

//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/* @validate para inicializar varivles para validar*/
                validator::validateEdit();

                $ids = array(
                    detalleHojaTableClass::ID => $id
                );
                /*                 * @var $data recorre los datos de la tabla en model

                 */
                $data = array(
                    detalleHojaTableClass::PESO_CERDO => $peso_cerdo,
                    detalleHojaTableClass::UNIDAD_MEDIDA_ID => $unidad_medida,
                    detalleHojaTableClass::HOJA_VIDA_ID => $id_hoja_vida,
                    detalleHojaTableClass::INSUMO_ID => $insumo,
                    detalleHojaTableClass::DOSIS => $dosis,
                    detalleHojaTableClass::TIPO_INSUMO_ID => $tipo_insumo,
                );
                detalleHojaTableClass::update($ids, $data);

                session::getInstance()->setSuccess('El registro se modificó exitosamente'); /* mensaje de exito 'detalle_salida_salida_bodega_id' => 6 */
                routing::getInstance()->redirect('detalleHoja', 'index', array(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true) => $id_hoja_vida)); /* request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::SALIDA_BODEGA_ID, true)) => $id_salida_bodega */
            } else {
                session::getInstance()->setError('Error de edición');
                routing::getInstance()->redirect('detalleHoja', 'edit');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->forward('detalleHoja', 'edit');
            session::getInstance()->setFlash('exc', $exc);
        }
    }

}
