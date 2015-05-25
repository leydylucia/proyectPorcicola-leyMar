<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of ejemploClass
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo insumo
 */
class createInsumoActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variables 
     * @var $desc_insumo=> descripcion insumo
     * @var $precio=> precio
     * @var $tipoInsumo=> id tipo insumo
     * @var $fechaFabricacion=> fecha fabricacion
     * @var $fechaVencimiento=> fecha vencimiento
     * @var $proveedorId =>id del proveedor
     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $desc_insumo = trim(request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true)));
                $precio = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PRECIO, true));
                $tipoInsumo = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::TIPO_INSUMO_ID, true));
                $fechaFabricacion = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true));
                $fechaVencimiento = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true));
                $proveedorId = request::getInstance()->getPost(insumoTableClass::getNameField(insumoTableClass::PROVEEDOR_ID, true));


                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/*@ $this->validate para validar campos*/


                /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
                $data = array(
                    insumoTableClass::DESC_INSUMO => $desc_insumo,
                    insumoTableClass::PRECIO => $precio,
                    insumoTableClass::TIPO_INSUMO_ID => $tipoInsumo,
                    insumoTableClass::FECHA_FABRICACION => $fechaFabricacion,
                    insumoTableClass::FECHA_VENCIMIENTO => $fechaVencimiento,
                    insumoTableClass::PROVEEDOR_ID => $proveedorId,
                );
                insumoTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
                // log::register('insertar', insumoTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('insumo', 'indexInsumo');
            } else {
                routing::getInstance()->redirect('insumo', 'indexInsumo');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->redirect('insumo', 'insertInsumo');
            session::getInstance()->setFlash('exc', $exc);
            //routing::getInstance()->forward('shfSecurity', 'exception');    
        }
    }

    
    /* @ function para validar campos de formulario*/
    static public function Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento) {
        $flag = false;
        if (strlen($desc_insumo) > insumoTableClass::DESC_INSUMO_LENGTH) {
            session::getInstance()->setError(i18n::__('errorLength', null, 'default', array('%insumo%' => $desc_insumo, '%caracteres%' => insumoTableClass::DESC_INSUMO_LENGTH)));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true), true);
        }

//        if (!ereg("^[A-Z a-z_]*$", $desc_insumo)) {//validacion de tan solo letras
//            session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $desc_insumo)));
//            $flag = true;
//            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, TRUE), TRUE);
//        }

        if (!is_numeric($precio)) {//validacion de numeros
            session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true), true);
        }

        if ($desc_insumo === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::DESC_INSUMO, true), true);
        }

        if ($precio === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::PRECIO, true), true);
        }
        if ($fechaFabricacion === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_FABRICACION, true), true);
        }
        if ($fechaVencimiento === '') {// validacion de campo vacio
            session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
            $flag = true;
            session::getInstance()->setFlash(insumoTableClass::getNameField(insumoTableClass::FECHA_VENCIMIENTO, true), true);
        }



        if ($flag === true) {
            request::getInstance()->setMethod('GET');
            routing::getInstance()->forward('insumo', 'insertInsumo');
        }
    }

}
