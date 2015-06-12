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
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      
      //-------------------------------campo genero-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El genero de hojaVida es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El genero no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true))) > \hojaVidaTableClass::GENERO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El genero digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }
      
      
      //---------------------------------------campo id_madre------------------------------------------//
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ID_MADRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El id de la madre de hojaVida es requerido', 'inputDocumento');
      } //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ID_MADRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputDocumento');
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
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo campo---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ID_MADRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El campo de hojaVida es requerido', 'inputDocumento');
      } //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ID_MADRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDocumento', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputDocumento');
      } 
      
      //-------------------------------campo genero-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El genero de hojaVida es requerido', 'inputNombre');
      } //----solo permitir letras----
        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true))))){
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El genero no permite numeros, solo letras', 'inputNombre');
      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::GENERO, true))) > \hojaVidaTableClass::GENERO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputNombre', true);
        session::getInstance()->setError('El genero digitado es mayor en cantidad de caracteres a lo permitido', 'inputNombre');
      }

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\hojaVidaTableClass::ID => request::getInstance()->getPost(\hojaVidaTableClass::getNameField(\hojaVidaTableClass::ID, true))));
        routing::getInstance()->forward('animal', 'edit');
      }
    }
  }
  
}