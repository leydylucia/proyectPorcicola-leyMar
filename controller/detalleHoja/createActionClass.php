<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\detalleHojaValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;
//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 *  Description of createActionClass esta clase sirve para 
 *  el create carge datos de la tabla y cumple con la funcion de insertar
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo insumo
 */
class createActionClass extends controllerClass implements controllerActionInterface {
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

                $peso_cerdo = trim(request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::PESO_CERDO, true)));
                $unidad_medida = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::UNIDAD_MEDIDA_ID, true));
                $hoja_vida = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, TRUE));
                $insumo = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::INSUMO_ID, true));
                $dosis = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::DOSIS, true));
                $tipo_insumo = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::TIPO_INSUMO_ID, true));

//                echo $salida_bodega;
//                exit();
//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/*@ $this->validate para validar campos*/
                validator::validateInsert();

                /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
                $data = array(
                    detalleHojaTableClass::PESO_CERDO => $peso_cerdo,
                    detalleHojaTableClass::UNIDAD_MEDIDA_ID => $unidad_medida,
                    detalleHojaTableClass::HOJA_VIDA_ID => $hoja_vida,
                    detalleHojaTableClass::INSUMO_ID => $insumo,
                    detalleHojaTableClass::DOSIS => $dosis,
                    detalleHojaTableClass::TIPO_INSUMO_ID => $tipo_insumo,
                );


                detalleHojaTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
//                log::register('insertar', detalleHojaTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('detalleHoja', 'index',array(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID,true) => $hoja_vida));//redireccionamiento para sostener el id
            } else {
                routing::getInstance()->redirect('detalleHoja', 'index');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->redirect('detalleHoja', 'insert');
            session::getInstance()->setFlash('exc', $exc);
            //routing::getInstance()->forward('shfSecurity', 'exception');    
        }
    }

}
