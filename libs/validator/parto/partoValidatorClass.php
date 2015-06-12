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
   * @author Alexandra Florez
   */
  class partoValidatorClass extends validatorClass {
    public static function validateInsert() {
      $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo fecha_nacimiento---------------------
        //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::FECHA_NACIMIENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputFecha', true);
        session::getInstance()->setError('Fecha_nacimiento del parto es requerido', 'inputFecha');
      } 
      //-------------------------------campo NUM_NACIDOS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_NACIDOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNacidos', true);
        session::getInstance()->setError('El numero de nacidos del parto es requerido', 'inputNacidos');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_NACIDOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNacidos', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputNacidos');
      } 
      
   //-------------------------------campo NUM_VIVOS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_VIVOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputVivos', true);
        session::getInstance()->setError('El numero de vivos del parto es requerido', 'inputVivos');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_VIVOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputVivos', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputVivos');
      } 
      
    //-------------------------------campo NUM_MUERTOS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MUERTOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMuertos', true);
        session::getInstance()->setError('Numero de muertos del parto es requerido', 'inputMuertos');
        } 
        //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MUERTOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMuertos', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputMuertos');
      } 
        
        //-------------------------------campo NUM_HEMBRAS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_HEMBRAS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputHembra', true);
        session::getInstance()->setError('El numero de Hembras del parto es requerido', 'inputHembra');
        }
        //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_HEMBRAS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputHembra', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputHembra');
      } 
      
    //-------------------------------campo NUM_MACHOS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MACHOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMacho', true);
        session::getInstance()->setError('El numero de machos del parto es requerido', 'inputMacho');
        }  //----solo numeros----     
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MACHOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMacho', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputMacho');
      }
      
        
      //-------------------------------campo FECHA_MONTADA-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::FECHA_MONTADA, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMont', true);
        session::getInstance()->setError('fecha_montada del parto es requerido', 'inputMont');
        }  
        
        
      //-------------------------------campo ID_PADRE-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID_PADRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPadre', true);
        session::getInstance()->setError('El id_padre del parto es requerido', 'inputPadre');
        }  //----solo numeros----     
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID_PADRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPadre', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputPadre');
      }
          
//-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        //request::getInstance()->setMethod('GET');
        routing::getInstance()->forward('parto', 'insert');
      }
    }
    
    public static function validateEdit() {
     $flag = false;
//      $soloNumeros = "/^[[:digit:]]+$/";
      $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
      //------------------------------------campo fecha_nacimiento---------------------
         //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::FECHA_NACIMIENTO, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputFecha', true);
        session::getInstance()->setError('Fecha_nacimiento del parto es requerido', 'inputFecha');
      } 
      //-------------------------------campo NUM_NACIDOS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_NACIDOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNacidos', true);
        session::getInstance()->setError('El numero de nacidos del parto es requerido', 'inputNacidos');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_NACIDOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputNacidos', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputNacidos');
      } 
      
   //-------------------------------campo NUM_VIVOS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_VIVOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputVivos', true);
        session::getInstance()->setError('El numero de vivos del parto es requerido', 'inputVivos');
      } 
      //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_VIVOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputVivos', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputVivos');
      } 
      
    //-------------------------------campo NUM_MUERTOS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MUERTOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMuertos', true);
        session::getInstance()->setError('Numero de muertos del parto es requerido', 'inputMuertos');
        } 
        //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MUERTOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMuertos', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputMuertos');
      } 
        
        //-------------------------------campo NUM_HEMBRAS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_HEMBRAS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputHembra', true);
        session::getInstance()->setError('El numero de Hembras del parto es requerido', 'inputHembra');
        }
        //----solo numeros----
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_HEMBRAS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputHembra', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputHembra');
      } 
      
    //-------------------------------campo NUM_MACHOS-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MACHOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMacho', true);
        session::getInstance()->setError('El numero de machos del parto es requerido', 'inputMacho');
        }  //----solo numeros----     
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MACHOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMacho', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputMacho');
      }
      
        
      //-------------------------------campo FECHA_MONTADA-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::FECHA_MONTADA, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputMont', true);
        session::getInstance()->setError('fecha_montada del parto es requerido', 'inputMont');
        }  
        
        
      //-------------------------------campo ID_PADRE-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID_PADRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPadre', true);
        session::getInstance()->setError('El id_padre del parto es requerido', 'inputPadre');
        }  //----solo numeros----     
        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID_PADRE, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputPadre', true);
        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputPadre');
      }
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\partoTableClass::ID => request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID, true))));
        routing::getInstance()->forward('parto', 'edit');
      }
    }
  }
  
}