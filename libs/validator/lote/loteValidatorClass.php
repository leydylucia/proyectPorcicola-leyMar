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
   * @author @author Alexandra Florez
   */
  class loteValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';

      //-------------------------------campo desc_lote-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDesc', true);
        session::getInstance()->setError('La descripcion del lote es requerido', 'inputDesc');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true))) > \loteTableClass::UBICACION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('El campo digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      }

      //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true))) > \loteTableClass::UBICACION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      }
      
      
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('lote', 'insert');
      }
    }
      

     public static function validateEdit() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo desc_lote-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDesc', true);
        session::getInstance()->setError('La descripcion del lote es requerido', 'inputDesc');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputDocumento');
      } 
      
      
      //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputDocumento');
      } 
       
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\loteTableClass::ID => request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::ID, true))));
        routing::getInstance()->forward('lote', 'edit');
      
      }
    }  
    
    
    public static function validateEditMas() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo desc_lote-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDesc', true);
        session::getInstance()->setError('La descripcion del lote es requerido', 'inputDesc');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true))) > \loteTableClass::UBICACION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('El campo digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      }

      //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true))) > \loteTableClass::UBICACION_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      }

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\loteTableClass::ID => request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::ID, true))));
        routing::getInstance()->forward('lote', 'edit');
      
      }
    }
  }
}