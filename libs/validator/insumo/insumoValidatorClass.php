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
   * @author leydy lucia castillo <leydylucia@hotmail.com>
   * @category modulo insumo
   */
  class insumoValidatorClass extends validatorClass {
    public static function validateInsert() {
       $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      
       //-------------------------------campo desc insumo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::DESC_INSUMO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescInsumo', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo descripcion insumo no puede estar vacio', 'inputDescInsumo');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::DESC_INSUMO, true))) > \insumoTableClass::DESC_INSUMO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescInsumo', true);
        session::getInstance()->setError('el insumo digitado es mayor en cantidad de caracteres a lo permitido', 'inputDescInsumo');
      } //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::DESC_INSUMO, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputDescInsumo', true);
//        session::getInstance()->setError('El campo descripcion  insumo no permite numeros, solo letras', 'inputDescInsumo');
//      } 
      //------------------------------------campo precio---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::PRECIO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPrecio', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo precio no puede estar vacio', 'inputPrecio');
        } //----solo numeros----      
       else if (!is_numeric(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::PRECIO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPrecio', true);
        session::getInstance()->setError('El campo precio no permite letras, solo numeros', 'inputPrecio');
      } 
      //------------------------------------campo tipo insumo---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::TIPO_INSUMO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputTipoIn', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo tipo insumo no puede estar vacio', 'inputTipoIn');
        } 
       //------------------------------------campo fecha fabricacion---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::FECHA_FABRICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputFechaFabricacion', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo fecha fabricacion no puede estar vacio', 'inputFechaFabricacion');
        } 
        
        //------------------------------------campo fecha vencimiento---------------------
        //----campo nulo----
    if (self::notBlank(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::FECHA_VENCIMIENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputFechaVencimiento', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo fecha vencimiento no puede estar vacio', 'inputFechaVencimiento');
        } 
      
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('insumo', 'insertInsumo');
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
      if (self::notBlank(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::DESC_INSUMO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputDescInsumo', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo descripcion insumo no puede estar vacio', 'inputDescInsumo');
        } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::DESC_INSUMO, true))) > \insumoTableClass::DESC_INSUMO_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputDescInsumo', true);
        session::getInstance()->setError('el insumo digitado es mayor en cantidad de caracteres a lo permitido', 'inputDescInsumo');
      } //----solo permitir letras----
//        else if (!preg_match($soloLetras, (request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::DESC_INSUMO, true))))){
//        $flag = true;
//        session::getInstance()->setFlash('inputDescInsumo', true);
//        session::getInstance()->setError('El campo descripcion  insumo no permite numeros, solo letras', 'inputDescInsumo');
//      } 
      //------------------------------------campo precio---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::PRECIO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPrecio', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo no puede estar vacio', 'inputPrecio');
        } //----solo numeros----      
       else if (!is_numeric(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::PRECIO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPrecio', true);
        session::getInstance()->setError('El campo precio no permite letras, solo numeros', 'inputPrecio');
      } 
       //------------------------------------campo fecha fabricacion---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::FECHA_FABRICACION, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputFechaFabricacion', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo fecha fabricacion no puede estar vacio', 'inputFechaFabricacion');
        } 
        
        //------------------------------------campo fecha vencimiento---------------------
        //----campo nulo----
    if (self::notBlank(request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::FECHA_VENCIMIENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputFechaVencimiento', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo fecha vencimiento no puede estar vacio', 'inputFechaVencimiento');
        } 
      
        
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\insumoTableClass::ID => request::getInstance()->getPost(\insumoTableClass::getNameField(\insumoTableClass::ID, true))));
        routing::getInstance()->forward('insumo', 'editInsumo');
      }
    }
  }
}