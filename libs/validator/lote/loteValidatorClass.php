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
   * @author Alexandra Florez <alexaflorez88@hotmail.com>
   */
  class loteValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDesc', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true))) > \loteTableClass::DESC_LOTE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDesc', true);
        session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      }
//      //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputNombre', true);
//        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
//      } 
//      
      
       //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
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
      
      //-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDesc', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true))) > \loteTableClass::DESC_LOTE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDesc', true);
        session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      }
//      //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputNombre', true);
//        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
//      } 
      
      
       //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
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
      
      //-------------------------------campo descripcion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDesc', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true))) > \loteTableClass::DESC_LOTE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDesc', true);
        session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputUbicacion');
      }
      //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::DESC_LOTE, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El nombre no permite numeros, solo letras', 'inputNombre');
      } 
      
      
       //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\loteTableClass::getNameField(\loteTableClass::UBICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del lote es requerido', 'inputUbicacion');
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