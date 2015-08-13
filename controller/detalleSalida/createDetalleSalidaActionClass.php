<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\validator\detalleSalidaValidatorClass as validator;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 *  Description of createActionClass esta clase sirve para 
 *  el create carge datos de la tabla y cumple con la funcion de insertar
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo insumo
 */
class createDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variables 
     * @return $desc_insumo=> descripcion insumo (string)
     * @return $precio=> precio (numerico)
     * @return $tipoInsumo=> id tipo insumo (bigint)
     * @return $fechaFabricacion=> fecha fabricacion(date)
     * @return $fechaVencimiento=> fecha vencimiento(date)
     * @return $proveedorId =>id del proveedor (bigint)
     * todas estos datos se pasa en la varible @var $data
     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $cantidad = trim(request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::CANTIDAD, true)));
//                $salida_bodega = request::getInstance()->getGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true));
                $salida_bodega = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, TRUE));
                $insumo = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::INSUMO_ID, true));
                $unidad_medida = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::UNIDAD_MEDIDA_ID, true));

//                echo $salida_bodega;
//                exit();
//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/*@ $this->validate para validar campos*/

                validator::validateInsert();
                /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
                $data = array(
                    detalleSalidaTableClass::CANTIDAD => $cantidad,
                    detalleSalidaTableClass::SALIDA_BODEGA_ID => $salida_bodega,
                    detalleSalidaTableClass::INSUMO_ID => $insumo,
                    detalleSalidaTableClass::UNIDAD_MEDIDA_ID => $unidad_medida,
                );


                detalleSalidaTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
//                log::register('insertar', detalleSalidaTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('detalleSalida', 'indexDetalleSalida',array(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID,true) => $salida_bodega));//redireccionamiento para sostener el id
            } else {
                routing::getInstance()->redirect('detalleSalida', 'indexDetalleSalida');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->redirect('detalleSalida', 'insertDetalleSalida');
            session::getInstance()->setFlash('exc', $exc);
            //routing::getInstance()->forward('shfSecurity', 'exception');    
        }
    }

}
