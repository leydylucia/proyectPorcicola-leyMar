<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;
use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 * Description of editInsumoActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de modificar datos
 *
 * @author leydy lucia castillo moaquera
 *  @category modulo insumo
 */
class editInsumoActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet(insumoTableClass::ID)) {
        $fields = array(
            insumoTableClass::ID,
            insumoTableClass::DESC_INSUMO,
//                    insumoTableClass::PRECIO,
            insumoTableClass::TIPO_INSUMO_ID,
            insumoTableClass::FECHA_FABRICACION,
            insumoTableClass::FECHA_VENCIMIENTO,
            insumoTableClass::PROVEEDOR_ID
        );
        $where = array(
            insumoTableClass::ID => request::getInstance()->getGet(insumoTableClass::ID)
        );
        $this->objInsumo = insumoTableClass::getAll($fields, true, null, null, null, null, $where);

        //estos campo son para llamar las foraneas
        $fields = array(/* foranea de tipo insumo */
            tipoInsumoTableClass::ID,
            tipoInsumoTableClass::DESC_TIPOIN
        );
        $orderBy = array(
            tipoInsumoTableClass::DESC_TIPOIN
        );
        $this->objTipoin = tipoinsumoTableClass::getAll($fields, true, $orderBy, 'ASC');

        $fieldsProveedor = array(/* foranea proveedor */
            proveedorTableClass::ID,
            proveedorTableClass::NOMBRE,
            proveedorTableClass::APELLIDO
        );
        $orderByProvedor = array(
            proveedorTableClass::NOMBRE
        );
        $this->objProv = proveedorTableClass::getAll($fieldsProveedor, true, $orderByProvedor, 'ASC');

        $this->defineView('edit', 'insumo', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */


        log::register('editar', insumoTableClass::getNameTable()); //linea de bitacora
      } else {
        routing::getInstance()->redirect('insumo', 'indexInsumo');
        session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
      }
    } catch (PDOException $exc) {

      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}

//echo '$ ' . number_format($precio, 0, ',', '.');
