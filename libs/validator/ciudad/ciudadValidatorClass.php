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
   * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
   */
  class ciudadValidatorClass extends validatorClass {

    public static function validateInsert() {
      $flag = false;

//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';

      //-------------------------------campo ubicacion-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCiu', true);
        session::getInstance()->setError('La ciudad es requerido', 'inputCiu');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true))) > \ciudadTableClass::NOM_CIUDAD_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputCiu', true);
        session::getInstance()->setError('La Ciudad digitada es mayor en cantidad de caracteres a lo permitido', 'inputCiu');
      }
      //----solo permitir letras----
      else if (!preg_match($soloLetras, (request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true))))) {
        $flag = true;
        session::getInstance()->setFlash('inputCiud', true);
        session::getInstance()->setError('El campo Ciudad no permite numeros, solo letras', 'inputCiud');
      }

      //-------------------------------campo depto-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCiudad', true);
        session::getInstance()->setError('El departamento es requerido', 'inputCiudad');
      }

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('proveedor', 'insertCiudad');
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
      if (self::notBlank(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCiu', true);
        session::getInstance()->setError('La ubicacion del ciudad es requerido', 'inputCiu');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true))) > \ciudadTableClass::NOM_CIUDAD_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputCiu', true);
        session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputCiu');
      }


      //-------------------------------campo depto-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCiudad', true);
        session::getInstance()->setError('El departamento es requerido', 'inputCiudad');
      }

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\ciudadTableClass::ID => request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::ID, true))));
        routing::getInstance()->forward('proveedor', 'editCiudad');
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
      if (self::notBlank(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCiu', true);
        session::getInstance()->setError('La ubicacion del ciudad es requerido', 'inputCiu');
      } //----sobre pasar los caracteres----
      else if (strlen(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true))) > \ciudadTableClass::NOM_CIUDAD_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputCiu', true);
        session::getInstance()->setError('La ubicacion digitada es mayor en cantidad de caracteres a lo permitido', 'inputCiu');
      }

      //-------------------------------campo depto-----------------------------
      //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCiudad', true);
        session::getInstance()->setError('El departamento es requerido', 'inputCiudad');
      }

      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\ciudadTableClass::ID => request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::ID, true))));
        routing::getInstance()->forward('proveedor', 'editCiudad');
      }
    }

    public static function validateFiltroCiudad(){
      $soloLetras = "/^[a-z]+$/i";
      if (strlen(request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true))) > \ciudadTableClass::NOM_CIUDAD_LENGTH) {
        session::getInstance()->setError('La Ciudad digitada es mayor en cantidad de caracteres a lo permitido', 'inputCiud');
      }
      else if (!preg_match($soloLetras, (request::getInstance()->getPost(\ciudadTableClass::getNameField(\ciudadTableClass::NOM_CIUDAD, true))))) {
        session::getInstance()->setError('El campo Ciudad no permite numeros, solo letras', 'inputCiud');
      }     
    }
  }

}