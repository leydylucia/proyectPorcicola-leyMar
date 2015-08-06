<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\validator\entradaValidatorClass as validator;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 */
class createEnActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->isMethod('POST')) {

                $empleado_id = request::getInstance()->getPost(entradaTableClass::getNameField(entradaTableClass::EMPLEADO_ID, true));
                $proveedor_id = request::getInstance()->getPost(entradaTableClass::getNameField(entradaTableClass::PROVEEDOR_ID, true));

                //  $this->Validate($empleado_id, $proveedor_id); 
                validator::validateInsert();
                $data = array(
                    entradaTableClass::EMPLEADO_ID => $empleado_id,
                    entradaTableClass::PROVEEDOR_ID => $proveedor_id
                );

                entradaTableClass::insert
                        ($data);

                session::getInstance()->setSuccess('Registro Exitoso');

                routing::getInstance()->redirect('entrada', 'indexEn');
            } else {
                routing::getInstance()->redirect('entrada', 'indexEn');
            }
        } catch (PDOException $exc) {
            routing::getInstance()->redirect('entrada', 'insertEn');
            session::getInstance()->setFlash('exc', '$exc');
        }
    }

    // VALIDACIONES
//  private function Validate($empleado_id, $proveedor_id) {
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
