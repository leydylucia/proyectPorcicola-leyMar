<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\validator\usuarioCredencialValidatorClass as validator;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of createActionClass esta clase sirve para 
 *  el create carge datos de la tabla y cumple con la funcion de insertar
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo usuarioCredencial
 */
class createUsuarioCredencialActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @var $usuario=> desc usuario
   * @var $credencial=> desc credencial

   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $usuario = trim(request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::USUARIO_ID, true)));
        $credencial = request::getInstance()->getPost(usuarioCredencialTableClass::getNameField(usuarioCredencialTableClass::CREDENCIAL_ID, true));


//                $this->Validate($desc_insumo, $precio, $fechaFabricacion, $fechaVencimiento);/*@ $this->validate para validar campos*/

        validator::validateInsert();
        /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
        $data = array(
            usuarioCredencialTableClass::USUARIO_ID => $usuario,
            usuarioCredencialTableClass::CREDENCIAL_ID => $credencial,
        );
        usuarioCredencialTableClass::insert($data);

        session::getInstance()->setSuccess('Registro Exitoso'); //<?php echo i18n::__('mensaje1')?;/*mensaje de exito*/
        log::register('insertar', usuarioCredencialTableClass::getNameTable()); //linea de bitacora
        routing::getInstance()->redirect('usuarioCredencial', 'indexUsuarioCredencial');
      } else {
        routing::getInstance()->redirect('usuarioCredencial', 'indexUsuarioCredencial');
      }
    } catch (PDOException $exc) {

      routing::getInstance()->redirect('usuarioCredencial', 'insertUsuarioCredencial');
      session::getInstance()->setFlash('exc', $exc);
      //routing::getInstance()->forward('shfSecurity', 'exception');    
    }
  }

}
