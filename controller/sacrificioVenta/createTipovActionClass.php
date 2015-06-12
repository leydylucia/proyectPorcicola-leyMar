<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\tipoVentaValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;
//use hook\log\logHookClass as log;/*linea de la bitacora*/
/**
 * Description of ejemploClass
 *@category modulo sacrificio venta
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class createTipovActionClass extends controllerClass implements controllerActionInterface {
    
     /* public function execute inicializa las variable 
     * @var $desc_tipoV=> descripcion tipo venta

     * ** */


    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $desc_tipoV = request::getInstance()->getPost(tipovTableClass::getNameField(tipovTableClass::DESC_TIPOV, true));



                validator::validateInsert();

                $data = array(
                    tipovTableClass::DESC_TIPOV => $desc_tipoV
                );
                tipovTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
               // log::register('insertar', tipoInsumoTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('sacrificioVenta', 'indexTipov');
            } else {
                routing::getInstance()->redirect('sacrificioVenta', 'indexTipoV');
            }
        } catch (PDOException $exc) {
     
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
