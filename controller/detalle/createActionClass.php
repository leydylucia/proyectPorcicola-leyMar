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
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $cantidad = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true));
        $valor = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true));
        $insumo_id = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, true));
        
      $idEntrada = request::getInstance()->getGet(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true));
      

        $data = array(
        detalleEntradaTableClass::CANTIDAD => $cantidad,
        detalleEntradaTableClass::ENTRADA_BODEGA_ID => $idEntrada,
        detalleEntradaTableClass::INSUMO_ID => $insumo_id,
        detalleEntradaTableClass::VALOR => $valor
        );

        detalleEntradaTableClass::insert($data);
 
        session::getInstance()->setSuccess('Registro Exitoso');
   
        routing::getInstance()->redirect('detalle', 'index');
      } else {
        routing::getInstance()->redirect('detalle', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('detalle', 'insert');
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
