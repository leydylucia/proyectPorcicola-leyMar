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
  class controlValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('El peso cerdo del control es requerido', 'inputUbicacion');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputDocumento');
      } 
      
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('control', 'insert');
      }
    }
  
  
  public static function validateEdit() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del control es requerido', 'inputUbicacion');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputDocumento');
      } 
       
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\controlTableClass::ID => request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::ID, true))));
        routing::getInstance()->forward('control', 'edit');
      
      }
    }
       
    
    
    public static function validateEditMas() {
      $flag = false;
      
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo fecha siembra----------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUbicacion', true);
        session::getInstance()->setError('La ubicacion del control es requerido', 'inputUbicacion');
      } //-//----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputDocumento');
      } 

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\controlTableClass::ID => request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::ID, true))));
        routing::getInstance()->forward('control', 'edit');
      
      }
    }
  }
}