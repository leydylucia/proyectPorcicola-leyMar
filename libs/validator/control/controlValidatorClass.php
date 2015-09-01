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
      $soloLetras = "/^[a-zA-Z ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPeso', true);
        session::getInstance()->setError('El peso cerdo del control es requerido', 'inputPeso');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPeso', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputPeso');
      } 
      
      //-------------------------------campo cerdo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::HOJA_VIDA, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCerdo', true);
        session::getInstance()->setError('El id del cerdo es requerido', 'inputCerdo');
        }
      
      //-------------------------------campo empleado-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::EMPLEADO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmpleado', true);
        session::getInstance()->setError('El empleado no puede estar vacio', 'inputEmpleado');
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
      $soloLetras = "/^[a-zA-Z ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo ubicacion-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPeso', true);
        session::getInstance()->setError('La ubicacion del control es requerido', 'inputPeso');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPeso', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputPeso');
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
      $soloLetras = "/^[a-zA-Z ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //-------------------------------campo fecha siembra----------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPeso', true);
        session::getInstance()->setError('El peso del Cerdo es requerido', 'inputPeso');
      } //-//----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPeso', true);
        session::getInstance()->setError('El peso del Cerdo no permite letras, solo numeros', 'inputPeso');
      } 
      
      //-------------------------------campo cerdo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::HOJA_VIDA, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCerdo', true);
        session::getInstance()->setError('El id del cerdo es requerido', 'inputCerdo');
        }

      //-------------------------------campo empleado-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::EMPLEADO_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputEmpleado', true);
        session::getInstance()->setError('El empleado no puede estar vacio', 'inputEmpleado');
        }  
        
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\controlTableClass::ID => request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::ID, true))));
        routing::getInstance()->forward('control', 'edit');
      
      }
    }
    
    public static function validateFiltroCerdo() {
         $soloLetras = "/^[a-zA-Z ]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
       if (!is_numeric(request::getInstance()->getPost(\controlTableClass::getNameField(\controlTableClass::PESO_CERDO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPeso', true);
        session::getInstance()->setError('El peso del Cerdo no permite letras, solo numeros', 'inputPeso');
      }      
      }
  }
}