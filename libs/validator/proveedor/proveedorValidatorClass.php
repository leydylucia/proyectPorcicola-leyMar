<?php
namespace mvc\validator {
  
  use mvc\validator\validatorClass;
  use mvc\session\sessionClass as session;
  use mvc\request\requestClass as request;
  use mvc\routing\routingClass as routing;
  use mvc\config\myConfigClass as config;
  /**
   * Description of manoObraValidatorClass
   *
   * @author Alexandra Florez
   */
  class proveedorValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-zA-Z ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo documento---------------------
        //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DOCUMENTO, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputDocumento', true);
//        session::getInstance()->setError('El documento del proveedor es requerido', 'inputDocumento');
//      } //----solo numeros----
        
//        else if (!is_numeric(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DOCUMENTO, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputDocumento', true);
//        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputDocumento');
//      } //----sobre pasar los caracteres----
//        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DOCUMENTO, true))) > \proveedorTableClass::DOCUMENTO_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputDocumento', true);
//        session::getInstance()->setError('El documento digitado es mayor en cantidad de caracteres a lo permitido', 'inputDocumento');
//      } //----datos duplicados----
//        else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUser')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputUser', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputUser');
//      }
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del proveedor es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::NOMBRE, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::NOMBRE, true))) > \proveedorTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

   //-------------------------------campo apellido-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::APELLIDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido del proveedor es requerido', 'inputApellido');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::APELLIDO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::APELLIDO, true))) > \proveedorTableClass::APELLIDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      }   
      
      
    //-------------------------------campo direccion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DIRECCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion del proveedor es requerido', 'inputDireccion');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DIRECCION, true))) > \proveedorTableClass::DIRECCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDireccion');
      }//-------------------------------campo ciudad-----------------------------
          //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::ID_CIUDAD, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('selectCiudad', true);
//        session::getInstance()->setError('La ciudad del proveedor es requerido', 'selectCiudad');
//        }
      
    //-------------------------------campo telefono-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono del proveedor es requerido', 'inputTelefono');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::TELEFONO, true))) > \proveedorTableClass::TELEFONO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono digitado es mayor en cantidad de caracteres a lo permitido', 'inputTelefono');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputTelefono');
      }
      
        
      //-------------------------------campo email-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::CORREO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email del proveedor es requerido', 'inputEmail');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::CORREO, true))) > \proveedorTableClass::CORREO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email digitado es mayor en cantidad de caracteres a lo permitido', 'inputEmail');
      }  //----solo email----
        else if (!preg_match($emailcorrecto, (request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::CORREO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('Por favor digite un corre válido ', 'inputEmail');
      }   //----datos duplicados----
//        else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUser')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputUser', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputUser');
//      }   
          
      //-------------------------------campo ciudad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::CIUDAD_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCiudad', true);
        session::getInstance()->setError('La Ciudad del proveedor es requerido', 'inputCiudad');
        }
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('proveedor', 'insertProv');
      }
    }
    
    public static function validateEdit() {
     $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-zA-Z ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo documento---------------------
        //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DOCUMENTO, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputDocumento', true);
//        session::getInstance()->setError('El documento del proveedor es requerido', 'inputDocumento');
//      } //----solo numeros----
//        
//        else if (!is_numeric(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DOCUMENTO, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputDocumento', true);
//        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputDocumento');
//      } //----sobre pasar los caracteres----
//        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DOCUMENTO, true))) > \proveedorTableClass::DOCUMENTO_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputDocumento', true);
//        session::getInstance()->setError('El documento digitado es mayor en cantidad de caracteres a lo permitido', 'inputDocumento');
//      } //----datos duplicados----
//        else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUser')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputUser', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputUser');
//      }
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del proveedor es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::NOMBRE, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::NOMBRE, true))) > \proveedorTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

   //-------------------------------campo apellido-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::APELLIDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido del proveedor es requerido', 'inputApellido');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::APELLIDO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::APELLIDO, true))) > \proveedorTableClass::APELLIDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      }   
      
      
    //-------------------------------campo direccion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DIRECCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion del proveedor es requerido', 'inputDireccion');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::DIRECCION, true))) > \proveedorTableClass::DIRECCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDireccion');
      }//-------------------------------campo ciudad-----------------------------
          //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::ID_CIUDAD, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('selectCiudad', true);
//        session::getInstance()->setError('La ciudad del proveedor es requerido', 'selectCiudad');
//        }
      
    //-------------------------------campo telefono-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono del proveedor es requerido', 'inputTelefono');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::TELEFONO, true))) > \proveedorTableClass::TELEFONO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono digitado es mayor en cantidad de caracteres a lo permitido', 'inputTelefono');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputTelefono');
      }
      
        
      //-------------------------------campo email-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::CORREO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email del proveedor es requerido', 'inputEmail');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::CORREO, true))) > \proveedorTableClass::CORREO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email digitado es mayor en cantidad de caracteres a lo permitido', 'inputEmail');
      }  //----solo email----
        else if (!preg_match($emailcorrecto, (request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::CORREO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('Por favor digite un corre válido ', 'inputEmail');
      }   //----datos duplicados----
//        else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUser')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputUser', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputUser');
//      }   
          
       //-------------------------------campo ciudad-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::CIUDAD_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCiudad', true);
        session::getInstance()->setError('La Ciudad del proveedor es requerido', 'inputCiudad');
        }
        
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\proveedorTableClass::ID => request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::ID, true))));
        routing::getInstance()->forward('proveedor', 'editProv');
      }
 
      }
  
      public static function validateFiltroNombre() {
         $soloLetras = "/^[a-zA-Z ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
       if (!preg_match($soloLetras, (request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::NOMBRE, true))))){
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } 
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::NOMBRE, true))) > \proveedorTableClass::NOMBRE_LENGTH) {
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }       
      }
      
      public static function validateFiltroApellido() {
         $soloLetras = "/^[a-zA-Z ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
       if (!preg_match($soloLetras, (request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::APELLIDO, true))))){
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
      } 
        else if(strlen(request::getInstance()->getPost(\proveedorTableClass::getNameField(\proveedorTableClass::APELLIDO, true))) > \proveedorTableClass::APELLIDO_LENGTH) {
        session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      }       
      }
    }
  
}