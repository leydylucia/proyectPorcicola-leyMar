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
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 */
class createTipoinActionClass extends controllerClass implements controllerActionInterface {
 /*public function execute inicializa las variable 
     * @var $desc_tipoIn=> descripcion tipo insumo
     
     * ***/

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $desc_tipoIn = request::getInstance()->getPost(tipoInsumoTableClass::getNameField(tipoInsumoTableClass::DESC_TIPOIN, true));


                if (strlen($desc_tipoIn) > tipoInsumoTableClass::DESC_TIPOIN_LENGTH) {
                    throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => tipoInsumoTableClass::DESC_TIPOIN_LENGTH)), 00001);
                }
/** @var $data recorre el campo  o campos seleccionados de la tabla deseada**/
                $data = array(
                    tipoInsumoTableClass::DESC_TIPOIN => $desc_tipoIn
                );
                tipoInsumoTableClass::insert($data);

                session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
               // log::register('insertar', tipoInsumoTableClass::getNameTable()); //linea de bitacora
                routing::getInstance()->redirect('insumo', 'indexTipoin');
            } else {
                routing::getInstance()->redirect('insumo', 'indexTipoin');
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
