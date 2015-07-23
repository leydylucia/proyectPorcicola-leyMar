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
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo usuarioCredencial
 */
class createSalidaBodegaActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variables 
     * @var $usuario=> desc usuario
     * @var $credencial=> desc credencial

     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $empleado = trim(request::getInstance()->getPost(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::EMPLEADO_ID, true)));



//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/*@ $this->validate para validar campos*/


                /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
                $data = array(
                    salidaBodegaTableClass::EMPLEADO_ID => $empleado,
                );
                salidaBodegaTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
                 log::register('insertar', salidaBodegaTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('salidaBodega', 'indexSalidaBodega');
            } else {
                routing::getInstance()->redirect('salidaBodega', 'indexSalidaBodega');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->redirect('salidaBodega', 'insertSalidaBodega');
            session::getInstance()->setFlash('exc', $exc);
            //routing::getInstance()->forward('shfSecurity', 'exception');    
        }
    }

}
