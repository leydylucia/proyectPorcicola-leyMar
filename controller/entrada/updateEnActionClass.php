<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 *  Description of updateActionClass esta clase sirve para 
 *  el update carge datos de la tabla y cumple con la funcion de modificar
 *
 * *@author Alexandra Florez <alexaflorez88@hotmail.com>
 * @category modulo entrada
 */
class updateEnActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $empleado id=> empleado(bigint)
   * @return $proveedor id=> proveedor id (bigint)

   * todas estos datos se pasa en la varible @var $data
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $id = request::getInstance()->getPost(entradaTableClass::getNameField(entradaTableClass::ID, true));
        $empleado_id = request::getInstance()->getPost(entradaTableClass::getNameField(entradaTableClass::EMPLEADO_ID, true));
        $proveedor_id = request::getInstance()->getPost(entradaTableClass::getNameField(entradaTableClass::PROVEEDOR_ID, true));


        $ids = array(
            entradaTableClass::ID => $id
        );

        $data = array(
            entradaTableClass::EMPLEADO_ID => $empleado_id,
            entradaTableClass::PROVEEDOR_ID => $proveedor_id
        );

        entradaTableClass::update($ids, $data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('entrada', 'indexEn');
      } else {
        routing::getInstance()->redirect('entrada', 'indexEn');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('entrada', 'updateEn');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

//  // VALIDACIONES
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
//      request::getInstance()->addParamGet(array(proveedorTableClass::ID => request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::ID, true))));
//      routing::getInstance()->forward('proveedor', 'editProv');
//    }
//  }
}
