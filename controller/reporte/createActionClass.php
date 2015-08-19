<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
//use mvc\validator\usuarioCredencialValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of ejemploClass
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo reporte
 */
class createActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las variables 
     * @var $usuario=> desc usuario
     * @var $credencial=> desc credencial

     * ** */

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $nombre = trim(request::getInstance()->getPost(reporteTableClass::getNameField(reporteTableClass::NOMBRE, true)));
                $descripcion = trim(request::getInstance()->getPost(reporteTableClass::getNameField(reporteTableClass::DESCRIPCION, true)));
                $direccion = trim(request::getInstance()->getPost(reporteTableClass::getNameField(reporteTableClass::DIRECCION, true)));



//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/*@ $this->validate para validar campos*/
//                validator::validateInsert();
                /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
                $data = array(
                    reporteTableClass::NOMBRE => $nombre,
                    reporteTableClass::DESCRIPCION => $descripcion,
                    reporteTableClass::DIRECCION => $direccion,
                );
                reporteTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
//                log::register('insertar', usuarioCredencialTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('reporte', 'index');
            } else {
                routing::getInstance()->redirect('reporte', 'index');
            }
        } catch (PDOException $exc) {

            routing::getInstance()->redirect('reporte', 'insert');
            session::getInstance()->setFlash('exc', $exc);
            //routing::getInstance()->forward('shfSecurity', 'exception');    
        }
    }

}
