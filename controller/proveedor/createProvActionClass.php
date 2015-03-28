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
class createProvActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $nombre = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::NOMBRE, true));
        $apellido = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::APELLIDO, true));
        $direccion = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::DIRECCION, true));
        $correo = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CORREO, true));
        $telefono = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::TELEFONO, true));
        $ciudad_id = request::getInstance()->getPost(proveedorTableClass::getNameField(proveedorTableClass::CIUDAD_ID, true));
        
        

       if (strlen($nombre) > proveedorTableClass::NOMBRE_LENGTH) {
         throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => proveedorTableClass::NOMBRE_LENGTH)), 00001);
        }

        $data = array(
            proveedorTableClass::NOMBRE => $nombre,
            proveedorTableClass::APELLIDO => $apellido,
            proveedorTableClass::DIRECCION => $direccion,
            proveedorTableClass::CORREO => $correo,
            proveedorTableClass::TELEFONO => $telefono,
            proveedorTableClass::CIUDAD_ID => $ciudad_id,
            
        );
        
        proveedorTableClass::insert
                ($data);
        
        session::getInstance()->setSuccess('Registro Exitoso');
        
        routing::getInstance()->redirect('proveedor', 'indexProv');
      } else {
        routing::getInstance()->redirect('proveedor', 'indexProv');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo '<pre>';
      print_r($exc->getTrace());
      echo '</pre>';
      //session::getInstance()->setError('Error');
    }
  }

}

 