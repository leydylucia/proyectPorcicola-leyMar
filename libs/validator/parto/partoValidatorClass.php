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
        session::getInstance()->setError('El campo numero de nacidos no permite letras, solo numeros', 'inputNacidos');
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
        session::getInstance()->setError('El campo numero de vivios no permite letras, solo numeros', 'inputVivos');
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
        session::getInstance()->setError('El campo numero de muertos no permite letras, solo numeros', 'inputMuertos');
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
        session::getInstance()->setError('El campo numero de hembras no permite letras, solo numeros', 'inputHembra');
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
        session::getInstance()->setError('El campo numero de machos no permite letras, solo numeros', 'inputMacho');
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
//        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID_PADRE, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputPadre', true);
//        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputPadre');
//      } //----sobre pasar los caracteres----
        else if(strlen(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID_PADRE, true))) > \partoTableClass::ID_PADRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputPadre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputPadre');
      }

      
      //-------------------------------campo cerdo-----------------------------
          //----campo nulo----
      if (self::notBlank(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::HOJA_VIDA_ID, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputCerdo', true);
        session::getInstance()->setError('El Id del cerdo es requerido', 'inputCerdo');
        }
        
        
      $fecha_nacimiento = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::FECHA_NACIMIENTO, true));
      $fecha_montada = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::FECHA_MONTADA, true));
      if (strtotime($fecha_nacimiento) < strtotime($fecha_montada)) {
        $flag = true;
        session::getInstance()->setFlash('inputMont', true); /* input usuario biene del formulario */
        session::getInstance()->setError('el campo Fecha Montada no puede ser mayor a la de Nacimiento', 'inputMont');
      }
      
      $num_nacidos = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_NACIDOS, true));
      $num_hembras = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_HEMBRAS, true));
      $num_machos = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MACHOS, true));
      if ($num_nacidos < ($num_hembras + $num_machos)) {
        $flag = true;
        session::getInstance()->setFlash('inputHembra', true); /* input usuario biene del formulario */
        session::getInstance()->setError('Los campos Numero Hembras y Numero de Machos no puede ser mayor al Numero Nacidos', 'inputHembra');
      }
      
      
      
//-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\partoTableClass::ID => request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID, true))));        
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
        session::getInstance()->setError('El campo numero de nacidos no permite letras, solo numeros', 'inputNacidos');
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
        session::getInstance()->setError('El campo numero de vivos no permite letras, solo numeros', 'inputVivos');
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
        session::getInstance()->setError('El campo numero de muertos no permite letras, solo numeros', 'inputMuertos');
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
        session::getInstance()->setError('El campo numero de hembras no permite letras, solo numeros', 'inputHembra');
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
        session::getInstance()->setError('El campo numero de machos no permite letras, solo numeros', 'inputMacho');
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
//        else if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID_PADRE, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputPadre', true);
//        session::getInstance()->setError('El campo no permite letras, solo numeros', 'inputPadre');
//      }
        else if(strlen(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID_PADRE, true))) > \partoTableClass::ID_PADRE_LENGTH) {
        $flag = true;
        session::getInstance()->setFlash('inputPadre', true);
        session::getInstance()->setError('El nombre digitado es mayor en cantidad de caracteres a lo permitido', 'inputPadre');
      }
      
      
      $fecha_nacimiento = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::FECHA_NACIMIENTO, true));
      $fecha_montada = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::FECHA_MONTADA, true));
      if (strtotime($fecha_nacimiento) < strtotime($fecha_montada)) {
        $flag = true;
        session::getInstance()->setFlash('inputMont', true); /* input usuario biene del formulario */
        session::getInstance()->setError('el campo Fecha Montada no puede ser mayor a la de Nacimiento', 'inputMont');
      }
 
      $num_nacidos = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_NACIDOS, true));
      $num_hembras = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_HEMBRAS, true));
      $num_machos = request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_MACHOS, true));
      if ($num_nacidos < ($num_hembras + $num_machos)) {
        $flag = true;
        session::getInstance()->setFlash('inputHembra', true); /* input usuario biene del formulario */
        session::getInstance()->setError('Los campos Numero Hembras y Numero de Machos no puede ser mayor a la totalidad de Numero Nacidos' . '  ' . $num_nacidos, 'inputHembra');
      }
      
      //-------------------------------condiccion de bandera true-----------------------------
      if ($flag === true) {
        request::getInstance()->setMethod('GET');
        request::getInstance()->addParamGet(array(\partoTableClass::ID => request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::ID, true))));        
        routing::getInstance()->forward('parto', 'edit');
      }
    }
//    public static function validateFiltroNacidos() {
//         $soloLetras = "/^[a-z]+$/i";
//      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
//      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
//      
//       if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_NACIDOS, true)))) {
//        $flag = true;
//        session::getInstance()->setFlash('inputNacidos', true);
//        session::getInstance()->setError('El campo Número Nacidos no permite letras, solo números', 'inputNacidos');
//      }      
//      }
      
      public static function validateFiltroVivos() {
         $soloLetras = "/^[a-z]+$/i";
      $soloTelefono = "/^(\d{3,3}\-\d{3,3}\-\d{4,4})|^(\+\d\-\d{3,3}\-\d{4,4})/";
      $emailcorrecto = '/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/';
      
       if (!is_numeric(request::getInstance()->getPost(\partoTableClass::getNameField(\partoTableClass::NUM_VIVOS, true)))) {
        $flag = true;
        session::getInstance()->setFlash('inputVivos', true);
        session::getInstance()->setError('El campo Número Vivos no permite letras, solo números', 'inputVivos');
      }      
      }
  }
  
}