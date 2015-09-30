<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\detalleEntradaValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

/**
 *  Description of updateActionClass esta clase sirve para 
 *  el update carge datos de la tabla y cumple con la funcion de modificar
 * @author alexandra marcela florez
 * @category modulo detalle
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

        $id = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, true));
        $cantidad = trim(request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)));
        $valor = trim(request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true)));
        $id_entrada_bodega = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true));
        $insumo = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, true));
        $unidad_medida = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::UNIDAD_MEDIDA_ID, true));

//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/* @validate para inicializar varivles para validar*/
        validator::validateEdit();

        $ids = array(
            detalleEntradaTableClass::ID => $id
        );
        /*         * @var $data recorre los datos de la tabla en model

         */
        $data = array(
            detalleEntradaTableClass::CANTIDAD => $cantidad,
            detalleEntradaTableClass::VALOR => $valor,
            detalleEntradaTableClass::ENTRADA_BODEGA_ID => $id_entrada_bodega,
            detalleEntradaTableClass::INSUMO_ID => $insumo,
            detalleEntradaTableClass::UNIDAD_MEDIDA_ID => $unidad_medida,
        );
        detalleEntradaTableClass::update($ids, $data);

        session::getInstance()->setSuccess('El registro se modificó exitosamente'); /* mensaje de exito 'detalle_salida_salida_bodega_id' => 6 */
        routing::getInstance()->redirect('detalle', 'index', array(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $id_entrada_bodega)); /* request::getInstance()->getGet(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::SALIDA_BODEGA_ID, true)) => $id_salida_bodega */
      } else {
        session::getInstance()->setError('Error de edición');
        routing::getInstance()->redirect('detalle', 'edit');
      }
    } catch (PDOException $exc) {

      routing::getInstance()->forward('detalle', 'edit');
      session::getInstance()->setFlash('exc', $exc);
    }
  }

}
