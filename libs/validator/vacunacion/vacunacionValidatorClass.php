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
  class vacunacionValidatorClass extends validatorClass {
    public static function validateInsert() {
       $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      
       //-------------------------------campo dosis-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::DOSIS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDosis', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo dosis no puede estar vacio', 'inputDosis');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::DOSIS, true))) > \vacunacionTableClass::DOSIS_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDosis', true);
        session::getInstance()->setError('la dosis digitada es mayor en cantidad de caracteres a lo permitido', 'inputDosis');
      } 
      //------------------------------------campo hora---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::HORA, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputHora', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo hora no puede estar vacio', 'inputHora');
        } 
    
      
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('vacunacion', 'insertVacunacion');
      }
    }
    
    public static function validateEdit() {
       $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      
        //-------------------------------campo desc insumo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::DESC_INSUMO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescInsumo', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo descripcion insumo no puede estar vacio', 'inputDescInsumo');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::DESC_INSUMO, true))) > \vacunacionTableClass::DESC_INSUMO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescInsumo', true);
        session::getInstance()->setError('el insumo digitado es mayor en cantidad de caracteres a lo permitido', 'inputDescInsumo');
      } 
      //------------------------------------campo precio---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::PRECIO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPrecio', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo no puede estar vacio', 'inputPrecio');
        } //----solo numeros----      
       else if (!is_numeric(request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::PRECIO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPrecio', true);
        session::getInstance()->setError('El campo precio no permite letras, solo numeros', 'inputPrecio');
      } 
       //------------------------------------campo fecha fabricacion---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::FECHA_FABRICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputFechaFabricacion', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo fecha fabricacion no puede estar vacio', 'inputFechaFabricacion');
        } 
        
        //------------------------------------campo fecha vencimiento---------------------
        //----campo nulo----
    if (self::notBlank(request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::FECHA_VENCIMIENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputFechaVencimiento', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo fecha vencimiento no puede estar vacio', 'inputFechaVencimiento');
        } 
      
        
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\vacunacionTableClass::ID => request::getInstance()->getPost(\vacunacionTableClass::getNameField(\vacunacionTableClass::ID, true))));
        routing::getInstance()->forward('insumo', 'editInsumo');
      }
    }
  }
}