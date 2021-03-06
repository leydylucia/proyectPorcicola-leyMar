<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\detalleEntradaValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 *  Description of createActionClass esta clase sirve para 
 *  el create carge datos de la tabla y cumple con la funcion de insertar
 *
 * @author alexandra marcela florez
 * @category modulo detalle
 */
class createActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $cantidad=> cantidad (bigint)
   * @return $valor=> valor (bigint)
   * @return $entrada_bodega=> entrada bodega id (bigint)
   * @return $insumo=> insumo(bigint)
   * @return $unidad_media=> unidad medida(bigint)

   * todas estos datos se pasa en la varible @var $data
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $cantidad = trim(request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true)));
        $valor = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true));
        $entrada_bodega = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, TRUE));
        $insumo = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, true));
        $unidad_media = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::UNIDAD_MEDIDA_ID, true));

//                echo $salida_bodega;
//                exit();
//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/*@ $this->validate para validar campos*/
        validator::validateInsert(); /* para validas los campos de la tabla y se redirige al validator */

        /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
        $data = array(
            detalleEntradaTableClass::CANTIDAD => $cantidad,
            detalleEntradaTableClass::VALOR => $valor,
            detalleEntradaTableClass::ENTRADA_BODEGA_ID => $entrada_bodega,
            detalleEntradaTableClass::INSUMO_ID => $insumo,
            detalleEntradaTableClass::UNIDAD_MEDIDA_ID => $unidad_media,
        );


        detalleEntradaTableClass::insert($data);

        session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
//                log::register('insertar', detalleEntradaTableClass::getNameTable()); //linea de bitacora
        routing::getInstance()->redirect('detalle', 'index', array(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true) => $entrada_bodega)); //redireccionamiento para sostener el id
      } else {
        routing::getInstance()->redirect('detalle', 'index');
      }
    } catch (PDOException $exc) {

      routing::getInstance()->redirect('detalle', 'insert');
      session::getInstance()->setFlash('exc', $exc);
      //routing::getInstance()->forward('shfSecurity', 'exception');    
    }
  }

}
