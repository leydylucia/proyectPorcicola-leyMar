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

        $id = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ID, true));
        $cantidad = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true));
        $valor = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true));
        $entrada_bodega_id = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true));
        $insumo_id = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, true));
        

        $ids = array(
            detalleEntradaTableClass::ID => $id
        );

        $data = array(
            detalleEntradaTableClass::CANTIDAD => $cantidad,
            detalleEntradaTableClass::VALOR => $valor,
            detalleEntradaTableClass::ENTRADA_BODEGA_ID => $entrada_bodega_id,
            detalleEntradaTableClass::INSUMO_ID => $insumo_id
        );

        detalleEntradaTableClass::update($ids, $data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('detalle', 'index');
      } else {
        routing::getInstance()->redirect('detalle', 'index');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('detalle', 'update');
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
