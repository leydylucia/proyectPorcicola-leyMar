<?php
namespace mvc\validator {
  
  use mvc\validator\validatorClass;
  use mvc\session\sessionClass as session;
  use mvc\request\requestClass as request;
  use mvc\routing\routingClass as routing;
  use mvc\config\myConfigClass as config;
  /**
  /**
   * Description of manoObraValidatorClass
   *
   * @author Alexandra Florez
   */
  class animalValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-z0-9_]+([.][a-z0-9_]+)*[@][a-z0-9_]+([.][a-z0-9_]+)*[.][a-z]{2,4}$/';
      
      
      //---------------------------------------campo id_madre------------------------------------------//
      //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ID_MADRE, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputDocumento', true);
//        session::getInstance()->setError('El id de la madre de hojaVida es requerido', 'inputDocumento');
//      } //----solo numeros----
//        else if (!is_numeric(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ID_MADRE, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputDocumento', true);
//        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputDocumento');
//      } 
      
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::NOMBRE_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del Cerdo es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::NOMBRE_CERDO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del Cerdo no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::NOMBRE_CERDO, true))) > \hojaVidaTableClass::NOMBRE_CERDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del Cerdo digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

      
       //-------------------------------campo genero-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputGenero', true);
        session::getInstance()->setError('El Genero de hojaVida es requerido', 'inputGenero');
        }
      
      //-------------------------------campo estado-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ESTADO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEstado', true);
        session::getInstance()->setError('El estado de hojaVida es requerido', 'inputEstado');
        }
      
      //-------------------------------campo lote-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::LOTE_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputLote', true);
        session::getInstance()->setError('El lote es requerido', 'inputLote');
        }  
        
      //-------------------------------campo raza-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::RAZA_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputRaza', true);
        session::getInstance()->setError('La raza es requerida', 'inputRaza');
        }    
        
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('animal', 'insert');
      }
    }
    
    public static function validateEdit() {
     $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
     
      
      //-------------------------------campo genero-----------------------------
          //----campo nulo----
//      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputGenero', true);
//        session::getInstance()->setError('El genero de hojaVida es requerido', 'inputGenero');
//      } //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputGenero', true);
//        session::getInstance()->setError('El genero no permite numeros, solo letras', 'inputGenero');
//      } //----sobre pasar los caracteres----
//        else if(strlen(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true))) > \hojaVidaTableClass::GENERO_LENGTH) {
//        $flag = true;
//        session::getInstance()->setFlash('inputGenero', true);
//        session::getInstance()->setError('El genero digitado es mayor en cantidad de caracteres a lo permitido', 'inputGenero');
//      }
      
      //-------------------------------campo nombre-----------------------------
          //----campo nulo----
       $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-z0-9_]+([.][a-z0-9_]+)*[@][a-z0-9_]+([.][a-z0-9_]+)*[.][a-z]{2,4}$/';
      
     if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::NOMBRE_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del Cerdo es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::NOMBRE_CERDO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del Cerdo no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::NOMBRE_CERDO, true))) > \hojaVidaTableClass::NOMBRE_CERDO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre del Cerdo digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }
      
      
      //-------------------------------campo genero-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputGenero', true);
        session::getInstance()->setError('El Genero de hojaVida es requerido', 'inputGenero');
        }
      
      //-------------------------------campo estado-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ESTADO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEstado', true);
        session::getInstance()->setError('El estado de hojaVida es requerido', 'inputEstado');
        }
      
      //-------------------------------campo lote-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::LOTE_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputLote', true);
        session::getInstance()->setError('El lote es requerido', 'inputLote');
        }
        
      //-------------------------------campo raza-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::RAZA_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputRaza', true);
        session::getInstance()->setError('La raza es requerida', 'inputRaza');
        }  
        
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\hojaVidaTableClass::ID => request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ID, true))));
        routing::getInstance()->forward('animal', 'edit');
      }
    }
    
//    public static function validateFiltroGenero() {
//         $soloLetras = "[/^a-z]+$/i";
//      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
//      $emailcorrecto = '/^[^0-9][a-z0-9_]+([.][a-z0-9_]+)*[@][a-z0-9_]+([.][a-z0-9_]+)*[.][a-z]{2,4}$/';
//      
//       if (!preg_match($soloLetras, (request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputGenero', true);
//        session::getInstance()->setError('El Genero no permite numeros, solo letras', 'inputGenero');
//      }      
//      }
  }
  
}