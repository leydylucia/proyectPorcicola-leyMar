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
   * @category modulo sacrificioVenta
   */
  class sacrificioVentaValidatorClass extends validatorClass {
    public static function validateInsert() {
       $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      
       //-------------------------------campo desc insumo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::VALOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo valor no puede estar vacio', 'inputValor');
        }  //----solo numeros----      
       else if (!is_numeric(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::VALOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El campo Valor no permite letras, solo numeros', 'inputValor');
      } 
     
      
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('sacrificioVenta', 'insertSacrificioVenta');
      }
    }
    
    public static function validateEdit() {
       $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      
           //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::VALOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);/*input usuario biene del formulario*/
        session::getInstance()->setError('el campo valor no puede estar vacio', 'inputValor');
        }  //----solo numeros----      
       else if (!is_numeric(request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::VALOR, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputValor', true);
        session::getInstance()->setError('El campo Valor no permite letras, solo numeros', 'inputValor');
      } 
        
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\sacrificiovTableClass::ID => request::getInstance()->getPost(\sacrificiovTableClass::getNameField(\sacrificiovTableClass::ID, true))));
        routing::getInstance()->forward('sacrificioVenta', 'editSacrificioVenta');
      }
    }
  }
}