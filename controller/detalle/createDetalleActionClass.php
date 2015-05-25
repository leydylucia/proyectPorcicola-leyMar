<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Alexandra Florez
 * @category modulo detalleEntrada
 */
class createDetalleActionClass extends controllerClass implements controllerActionInterface {
  
  /* public function execute inicializa las variables 
     * @var $nombre=> nombre del detalleEntrada
     * @var $apellido=> apellido del detalleEntrada
     * @var $direccion=> direccion del detalleEntrada
     * @var $correo=> correo del detalleEntrada
     * @var $telefono=> telefono del detalleEntrada
     * @var $ciudad_id =>ciudad a la que pertenece el detalleEntrada
     * ** */
  

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $cantidad = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, true));
        $valor = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, true));
        $entrada_bodega_id = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::ENTRADA_BODEGA_ID, true));
        $lote_id = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::LOTE_ID, true));
        $insumo_id = request::getInstance()->getPost(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::INSUMO_ID, true));
        

        $this->Validate($cantidad, $valor); /*@ $this->validate para validar campos*/
        
        /** @var $data recorre el campo  o campos seleccionados de la tabla deseada* */
        $data = array(
            detalleEntradaTableClass::CANTIDAD => $cantidad,
            detalleEntradaTableClass::VALOR => $valor,
            detalleEntradaTableClass::ENTRADA_BODEGA_ID => $entrada_bodega_id,
            detalleEntradaTableClass::LOTE_ID => $lote_id,
            detalleEntradaTableClass::INSUMO_ID => $insumo_id,
        );

        detalleEntradaTableClass::insert
                ($data);

        session::getInstance()->setSuccess('Registro Exitoso');

        routing::getInstance()->redirect('entrada', 'indexDetalle');
      } else {
        routing::getInstance()->redirect('entrada', 'indexDetalle');
      }
    } catch (PDOException $exc) {
      routing::getInstance()->redirect('entrada', 'insertDetalle');
      session::getInstance()->setFlash('exc', '$exc');
    }
  }

   /* @ function para validar campos de formulario*/
  private function Validate($cantidad, $valor) {
    $b = false;
    
    if (!is_numeric($cantidad)) {
      session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
      $b = true;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, TRUE), TRUE);
    }
    
    if (!is_numeric($valor)) {
      session::getInstance()->setError(i18n::__('errorNumeric', null, 'default'));
      $b = true;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, TRUE), TRUE);
    }
    
    
    // VALIDACIONES PARA NO ACEPTAR CAMPOS VACIOS
    if ($cantidad === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $b = true;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::CANTIDAD, TRUE), TRUE);
    }

    if ($valor === '') {
      session::getInstance()->setError(i18n::__('errorNull', null, 'default'));
      $b = true;
      session::getInstance()->setFlash(detalleEntradaTableClass::getNameField(detalleEntradaTableClass::VALOR, TRUE), TRUE);
    }

    
    
    if ($b === true) {
      request::getInstance()->setMethod('GET');
      routing::getInstance()->forward('entrada', 'insertDetalle');
    }
  }

}
