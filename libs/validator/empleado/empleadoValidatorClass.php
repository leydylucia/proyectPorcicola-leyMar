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
  class empleadoValidatorClass extends validatorClass {

    public static function validateInsert() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i"; //"/^[a-z]+$/i"
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';

      //-------------------------------campo nombre-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del empleado es requerido', 'inputNombre');
      } //----solo permitir letras----
      else if (!preg_match($soloLetras, (request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::NOMBRE, true))))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::NOMBRE, true))) > \empleadoTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

      //-------------------------------campo apellido-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::APELLIDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido del empleado es requerido', 'inputApellido');
      } //----solo permitir letras----
     else if (!preg_match($soloLetras, (request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::APELLIDO, true))))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::APELLIDO, true))) > \empleadoTableClass::APELLIDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      }


      //-------------------------------campo direccion-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DIRECCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion del empleado es requerido', 'inputDireccion');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DIRECCION, true))) > \empleadoTableClass::DIRECCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDireccion');
      }
      
       //-------------------------------campo ciudad-----------------------------
      //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::ID_CIUDAD, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('selectCiudad', true);
//        session::getInstance()->setError('La ciudad del empleado es requerido', 'selectCiudad');
//        }
        
      //-------------------------------campo telefono-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono del empleado es requerido', 'inputTelefono');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::TELEFONO, true))) > \empleadoTableClass::telefono_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono digitado es mayor en cantidad de caracteres a lo permitido', 'inputTelefono');
      }  //----valida que sea numerico----      
      else if (!is_numeric(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputTelefono');
      }

      //-------------------------------campo email-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::CORREO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email del empleado es requerido', 'inputEmail');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::CORREO, true))) > \empleadoTableClass::CORREO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email digitado es mayor en cantidad de caracteres a lo permitido', 'inputEmail');
      }  //----solo email----
      else if (!preg_match($emailcorrecto, (request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::CORREO, true))))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('Por favor digite un corre válido ', 'inputEmail');
      }   //----datos duplicados----
//        else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUser')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputUser', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputUser');
//      }   
//      
      //-------------------------------campo documento-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento del empleado es requerido', 'inputDocumento');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DOCUMENTO, true))) > \empleadoTableClass::DOCUMENTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento digitado es mayor en cantidad de caracteres a lo permitido', 'inputDocumento');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputDocumento');
      }
      
      //-------------------------------campo usuario-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::USUARIO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmpleado', true);
        session::getInstance()->setError('El Usuario del empleado es requerido', 'inputEmpleado');
      }

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('empleado', 'insert');
      }
    }

    public static function validateEdit() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";  //"/^[a-z]+$/i"
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';

        //-------------------------------campo documento-----------------------------
       //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento del empleado es requerido', 'inputDocumento');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DOCUMENTO, true))) > \empleadoTableClass::DOCUMENTO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento digitado es mayor en cantidad de caracteres a lo permitido', 'inputDocumento');
      }  //----valida que sea numerico----      
        else if (!is_numeric(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DOCUMENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputDocumento');
      }

      //-------------------------------campo nombre-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::NOMBRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del empleado es requerido', 'inputNombre');
      } //----solo permitir letras----
      else if (!preg_match($soloLetras, (request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::NOMBRE, true))))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::NOMBRE, true))) > \empleadoTableClass::NOMBRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

      //-------------------------------campo apellido-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::APELLIDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido del empleado es requerido', 'inputApellido');
      } //----solo permitir letras----
      else if (!preg_match($soloLetras, (request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::APELLIDO, true))))) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido no permite numeros, solo letras', 'inputApellido');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::APELLIDO, true))) > \empleadoTableClass::APELLIDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputApellido', true);
        session::getInstance()->setError('El apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputApellido');
      }

      //-------------------------------campo direccion-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DIRECCION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion del empleado es requerido', 'inputDireccion');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::DIRECCION, true))) > \empleadoTableClass::DIRECCION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDireccion', true);
        session::getInstance()->setError('La direccion digitada es mayor en cantidad de caracteres a lo permitido', 'inputDireccion');
      }//-------------------------------campo ciudad-----------------------------
      //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::ID_CIUDAD, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('selectCiudad', true);
//        session::getInstance()->setError('La ciudad del empleado es requerido', 'selectCiudad');
//        }
//        
      //-------------------------------campo telefono-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono del empleado es requerido', 'inputTelefono');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::TELEFONO, true))) > \empleadoTableClass::telefono_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El telefono digitado es mayor en cantidad de caracteres a lo permitido', 'inputTelefono');
      }  //----valida que sea numerico----      
      else if (!is_numeric(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::TELEFONO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTelefono', true);
        session::getInstance()->setError('El documento no permite letras, solo numeros', 'inputTelefono');
      }


      //-------------------------------campo email-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::CORREO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email del empleado es requerido', 'inputEmail');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::CORREO, true))) > \empleadoTableClass::CORREO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('El email digitado es mayor en cantidad de caracteres a lo permitido', 'inputEmail');
      }  //----solo email----
      else if (!preg_match($emailcorrecto, (request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::CORREO, true))))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmail', true);
        session::getInstance()->setError('Por favor digite un corre válido ', 'inputEmail');
      }   //----datos duplicados----
//        else if(self::isUnique(\usuarioTableClass::ID, true, array(\usuarioTableClass::USER => request::getInstance()->getPost('inputUser')), \usuarioTableClass::getNameTable())) {
//        $flag = true;
//        session::getInstance()->setFlash('inputUser', true);
//        session::getInstance()->setError('El usuario digitado ya existe', 'inputUser');
//      }   
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\empleadoTableClass::ID => request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::ID, true))));
        routing::getInstance()->forward('empleado', 'edit');
      }
    }
    
     public static function validateFiltroNombre() {
         $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
       if (!preg_match($soloLetras, (request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::NOMBRE, true))))){
        session::getInstance()->setError('El Nombre no permite numeros, solo letras', 'inputNombre');
      } 
        else if(strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::NOMBRE, true))) > \empleadoTableClass::NOMBRE_LENGTH) {
        session::getInstance()->setError('El Nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }       
      }
      
    public static function validateFiltroApellido() {
         $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
       if (!preg_match($soloLetras, (request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::APELLIDO, true))))){
        session::getInstance()->setError('El Apellido no permite numeros, solo letras', 'inputNombre');
      } 
        else if(strlen(request::getInstance()->getPost(\empleadoTableClass::getNameField(\empleadoTableClass::APELLIDO, true))) > \empleadoTableClass::APELLIDO_LENGTH) {
        session::getInstance()->setError('El Apellido digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }       
      }  

  }

}