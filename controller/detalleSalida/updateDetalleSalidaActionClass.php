<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 *  Description of updateActionClass esta clase sirve para 
 *  el update carge datos de la tabla y cumple con la funcion de modificar
 * @category modulo insumo
 * @author leydy lucia castillo
 * 
 */
class updateDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {

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

                $id = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::ID, true));
                $cantidad = trim(request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true)));

                $id_salida_bodega = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true));

                $insumo = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::INSUMO_ID, true));

//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/* @validate para inicializar varivles para validar*/



                $ids = array(
                    detalleSalidaTableClass::ID => $id
                );
                /*                 * @var $data recorre los datos de la tabla en model

                 */
                $data = array(
                    detalleSalidaTableClass::CANTIDAD => $cantidad,
                    detalleSalidaTableClass::SALIDA_BODEGA_ID => $id_salida_bodega,
                    detalleSalidaTableClass::INSUMO_ID => $insumo,
                );
                detalleSalidaTableClass::update($ids, $data);

                session::getInstance()->setSuccess('El registro se modificó exitosamente'); /* mensaje de exito 'detalle_salida_salida_bodega_id' => 6*/
                routing::getInstance()->redirect('detalleSalida', 'indexDetalleSalida', array(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true) => $id_salida_bodega));/*request::getInstance()->getGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true)) => $id_salida_bodega*/
            } else {
                session::getInstance()->setError('Error de edición');
                routing::getInstance()->redirect('detalleSalida', 'editDetallesalida');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->forward('detalleSalida', 'editDetalleSalida');
            session::getInstance()->setFlash('exc', $exc);
        }
    }

}
