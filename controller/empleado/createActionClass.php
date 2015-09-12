<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\empleadoValidatorClass as validator;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {
        
        $nombre = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true));
        $usuario_id = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, true));
        $tipo_id_id = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID_ID, true));
        $documento = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DOCUMENTO, true));
        $apellido = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true));
        $correo = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true));
        $telefono = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true));

  //     $this->Validate($nombre, $apellido, $direccion, $correo, $telefono);
        
        validator::validateInsert(); /*para validas los campos de la tabla y se redirige al validator*/

        $data = array(
            empleadoTableClass::NOMBRE => $nombre,
            empleadoTableClass::USUARIO_ID => $usuario_id,
            empleadoTableClass::TIPO_ID_ID => $tipo_id_id,
            empleadoTableClass::DOCUMENTO => $documento,
            empleadoTableClass::APELLIDO => $apellido,
            empleadoTableClass::DIRECCION => $direccion,
            empleadoTableClass::CORREO => $correo,
            empleadoTableClass::TELEFONO => $telefono
        );

        empleadoTableClass::insert($data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('empleado', 'index');
      } else {
        routing::getInstance()->redirect('empleado', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

  // VALIDACIONES
//  private function Validate($nombre, $apellido, $direccion, $correo, $telefono) {
//    $cal = false;
//      if (strlen($nombre) > empleadoTableClass::NOMBRE_LENGTH) {
//        session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => empleadoTableClass::NOMBRE_LENGTH)));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, TRUE), TRUE);
//      }
//  
//      if (strlen($apellido) > empleadoTableClass::APELLIDO_LENGTH) {
//        session::getInstance()->setError(i18n::__('errorLengthLastName', null, 'default', array('%apellido%' => empleadoTableClass::APELLIDO_LENGTH)));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, TRUE), TRUE);
//      }
//  
//      if ($direccion > empleadoTableClass::DIRECCION_LENGTH) {
//        session::getInstance()->setError(i18n::__('errorAdress', null, 'default', array('%direccion%' => empleadoTableClass::DIRECCION_LENGTH)));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, TRUE), TRUE);
//      }
//  
//      if (!is_numeric($telefono)) {
//        session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, TRUE), TRUE);
//      }
//  
//      if (!preg_match('{^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$}', $correo)) {
//        session::getInstance()->setError(i18n::__('errorMail', null, 'default'));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, TRUE), TRUE);
//      }
//      // validacion string
//      if (!ereg("^[A-Z a-z_]*$", $nombre)) {
//        session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $nombre)));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, TRUE), TRUE);
//      }
//      
//      if (!ereg("^[A-Z a-z_]*$", $apellido)) {
//        session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $apellido)));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, TRUE), TRUE);
//      }
//  
//      // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
//      if ($nombre === '') {
//        session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, TRUE), TRUE);
//      }
//  
//      if ($apellido === '') {
//        session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, TRUE), TRUE);
//      }
//  
//      if ($direccion === '') {
//        session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, TRUE), TRUE);
//      }
//  
//      if ($correo === '') {
//        session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, TRUE), TRUE);
//      }
//  
//      if ($telefono === '') {
//        session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//        $cal = true;
//        session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, TRUE), TRUE);
//      }
//
//    if ($cal === true) {
//      request::getInstance()->setMethod('GET');
//      routing::getInstance()->forward('empleado', 'insert');
//    }
//  }

}
