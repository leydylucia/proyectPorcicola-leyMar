<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use mvc\validator\proveedorValidatorClass as validator;

/**
 * Description of createProvActionClass
 * @author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo proveedor
 */
class createProvActionClass extends controllerClass implements controllerActionInterface {
  
  /* public function execute inicializa las variables 
     * @return $nombre=> nombre del proveedor (string)
     * @return $apellido=> apellido del proveedor (string)
     * @return $direccion=> direccion del proveedor (string)
     * @return $correo=> correo del proveedor (string)
     * @return $telefono=> telefono del proveedor (string)
     * @return $ciudad_id =>ciudad a la que pertenece el proveedor (numeric)
     * Todas estos datos se pasan en la variable @var $data 
     * ** */
  
  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true));
        $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true));
        $correo = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CORREO, true));
        $telefono = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true));
        $ciudad_id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CIUDAD_ID, true));

        // $this->Validate($nombre, $apellido, $direccion, $correo, $telefono); /*@ $this->validate para validar campos*/
        
        validator::validateInsert(); /*para validas los campos de la tabla y se redirige al validator*/
        
        /** @return $data recorre el campo  o campos seleccionados de la tabla deseada* */
        $data = array(
            proveedorTableClass::NOMBRE => $nombre,
            proveedorTableClass::APELLIDO => $apellido,
            proveedorTableClass::DIRECCION => $direccion,
            proveedorTableClass::CORREO => $correo,
            proveedorTableClass::TELEFONO => $telefono,
            proveedorTableClass::CIUDAD_ID => $ciudad_id,
        );

        proveedorTableClass::insert($data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('proveedor', 'indexProv');
      } else {
        routing::getInstance()->redirect('proveedor', 'indexProv');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('proveedor', 'insertProv');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

   /* @ function para validar campos de formulario*/
//  private function Validate($nombre, $apellido, $direccion, $correo, $telefono) {
//    $bono = false;
//    if (strlen($nombre) > proveedorTableClass::NOMBRE_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorLengthName', null, 'default', array('%nombre%' => proveedorTableClass::NOMBRE_LENGTH)));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE), TRUE);
//    }
//
//    if (strlen($apellido) > proveedorTableClass::APELLIDO_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorLengthLastName', null, 'default', array('%apellido%' => proveedorTableClass::APELLIDO_LENGTH)));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE), TRUE);
//    }
//
//    if ($direccion > proveedorTableClass::DIRECCION_LENGTH) {
//      session::getInstance()->setError(i18n::__('errorAdress', null, 'default', array('%direccion%' => proveedorTableClass::DIRECCION_LENGTH)));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, TRUE), TRUE);
//    }
//
//    if (!is_numeric($telefono)) {
//      session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE), TRUE);
//    }
//
//    if (!preg_match('{^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$}', $correo)) {
//      session::getInstance()->setError(i18n::__('errorMail', null, 'default'));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE), TRUE);
//    }
//
//    if (!ereg("^[A-Z a-z_]*$", $nombre)) {
//      session::getInstance()->setError(i18n::__('errorText', null, 'default', array('%texto%' => $nombre)));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE), TRUE);
//    }
//
//    // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
//    if ($nombre === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, TRUE), TRUE);
//    }
//
//    if ($apellido === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, TRUE), TRUE);
//    }
//
//    if ($direccion === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, TRUE), TRUE);
//    }
//
//    if ($correo === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::CORREO, TRUE), TRUE);
//    }
//
//    if ($telefono === '') {
//      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
//      $bono = true;
//      session::getInstance()->setFlash(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, TRUE), TRUE);
//    }
//
//    if ($bono === true) {
//      request::getInstance()->setMethod('GET');
//      routing::getInstance()->forward('proveedor', 'insertProv');
//    }
//  }

}
