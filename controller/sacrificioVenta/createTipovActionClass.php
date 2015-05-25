<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
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


                if (strlen($desc_tipoV) > tipovTableClass::DESC_TIPOV_LENGTH) {
                    throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => tipovTableClass::DESC_TIPOV_LENGTH)), 00001);
                }

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
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
//            session::getInstance()->setFlash('exc', $exc);
//            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
