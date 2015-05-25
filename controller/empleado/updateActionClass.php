<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class updateActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true));
        $nombre = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, true));
        $usuario_id = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::USUARIO_ID, true));
        $tipo_id_id = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TIPO_ID_ID, true));
        $apellido = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, true));
        $correo = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::CORREO, true));
        $telefono = request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, true));
        
        $this->Validate($nombre, $apellido, $direccion, $correo, $telefono);

        $ids = array(
            empleadoTableClass::ID => $id
        );

        $data = array(
            empleadoTableClass::NOMBRE => $nombre,
            empleadoTableClass::USUARIO_ID => $usuario_id,
            empleadoTableClass::TIPO_ID_ID => $tipo_id_id,
            empleadoTableClass::APELLIDO => $apellido,
            empleadoTableClass::DIRECCION => $direccion,
            empleadoTableClass::CORREO => $correo,
            empleadoTableClass::TELEFONO => $telefono
        );

        empleadoTableClass::update($ids, $data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('empleado', 'edit');
      } else {
        routing::getInstance()->redirect('empleado', 'edit');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('empleado', 'edit');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

  // VALIDACIONES
 private function Validate($nombre, $apellido, $direccion, $correo, $telefono) {
    $bono = false;
    if (strlen($nombre) > empleadoTableClass::NOMBRE_LENGTH) {
      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => empleadoTableClass::NOMBRE_LENGTH)));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, TRUE), TRUE);
    }

    if (strlen($apellido) > empleadoTableClass::APELLIDO_LENGTH) {
      session::getInstance()->setError(i18n::__('errorLengthLastName', null, 'default', array('%apellido%' => empleadoTableClass::APELLIDO_LENGTH)));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, TRUE), TRUE);
    }

    if ($direccion > empleadoTableClass::DIRECCION_LENGTH) {
      session::getInstance()->setError(i18n::__('errorAdress', null, 'default', array('%direccion%' => empleadoTableClass::DIRECCION_LENGTH)));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, TRUE), TRUE);
    }

    if (!is_numeric($telefono)) {
      session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, TRUE), TRUE);
    }

    if (!preg_match('{^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$}', $correo)) {
      session::getInstance()->setError(i18n::__('errorMail', null, 'default'));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, TRUE), TRUE);
    }

    if (!ereg("^[A-Z a-z_]*$", $nombre)) {
      session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $nombre)));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, TRUE), TRUE);
    }

    // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
    if ($nombre === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::NOMBRE, TRUE), TRUE);
    }

    if ($apellido === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::APELLIDO, TRUE), TRUE);
    }

    if ($direccion === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::DIRECCION, TRUE), TRUE);
    }

    if ($correo === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::CORREO, TRUE), TRUE);
    }

    if ($telefono === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $bono = true;
      session::getInstance()->setFlash(empleadoTableClass::getNameField(empleadoTableClass::TELEFONO, TRUE), TRUE);
    }

    if ($bono === true) {
      request::getInstance()->setMethod('GET');
      request::getInstance()->addParamGet(array(empleadoTableClass::ID => request::getInstance()->getPost(empleadoTableClass::getNameField(empleadoTableClass::ID, true))));
      routing::getInstance()->forward('empleado', 'edit');
    }
  }

}
