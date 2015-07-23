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
  class usuarioCredencialValidatorClass extends validatorClass {
    public static function validateInsert() {
       $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      
       //-------------------------------campo usuario-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::USUARIO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUsuario', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo usuario  no puede estar vacio', 'inputUsuario');
        } //----sobre pasar los caracteres----
        
      //-------------------------------campo credencial-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::CREDENCIAL_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCredencial', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo credencial  no puede estar vacio', 'inputCredencial');
        } //----sobre pasar los caracteres----  
        
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('usuarioCredencial', 'insertUsuarioCredencial');
      }
    }
    
    public static function validateEdit() {
       $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      
       //-------------------------------campo usuario-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::USUARIO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputUsuario', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo usuario  no puede estar vacio', 'inputUsuario');
        } //----sobre pasar los caracteres----
        
      //-------------------------------campo credencial-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::CREDENCIAL_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCredencial', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo credencial  no puede estar vacio', 'inputCredencial');
        } //----sobre pasar los caracteres----  
       
        
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\usuarioCredencialTableClass::ID => request::getInstance()->getPost(\usuarioCredencialTableClass::getNameField(\usuarioCredencialTableClass::ID, true))));
        routing::getInstance()->forward('usuarioCredencial', 'editUsuarioCredencial');
      }
    }
  }
}