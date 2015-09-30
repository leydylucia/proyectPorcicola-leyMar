<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log;/*linea de la bitacora*/

/**
 * Description of editActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de modificar datos
 *
 * @author leydy lucia castillo moaquera
 *  @category modulo detalleHoja
 */
class editActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->hasGet(detalleHojaTableClass::ID)) {
        $fields = array(
            detalleHojaTableClass::ID,
            detalleHojaTableClass::PESO_CERDO,
            detalleHojaTableClass::UNIDAD_MEDIDA_ID,
            detalleHojaTableClass::HOJA_VIDA_ID,
            detalleHojaTableClass::INSUMO_ID,
            detalleHojaTableClass::DOSIS,
            detalleHojaTableClass::TIPO_INSUMO_ID
        );
        $where = array(
            detalleHojaTableClass::ID => request::getInstance()->getGet(detalleHojaTableClass::ID)
        );
        $this->objDetalleHoja = detalleHojaTableClass::getAll($fields, true, null, null, null, null, $where);

        //estos campo son para llamar las foraneas
        $fields = array(/* foranea hoja vida */
            hojaVidaTableClass::ID,
        );
        $orderBy = array(
            hojaVidaTableClass::ID,
        );
        $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC');

        $fieldsInsumo = array(/* foranea insumo */
            insumoTableClass::ID,
            insumoTableClass::DESC_INSUMO
        );
        $orderByInsumo = array(
            insumoTableClass::DESC_INSUMO
        );
        $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');

        $fieldsTipoInsumo = array(/* foranea insumo */
            tipoInsumoTableClass::ID,
            tipoInsumoTableClass::DESC_TIPOIN
        );
        $orderByTipoInsumo = array(
            tipoInsumoTableClass::DESC_TIPOIN
        );
        $this->objTipoin = tipoInsumoTableClass::getAll($fieldsTipoInsumo, true, $orderByTipoInsumo, 'ASC');

        $fieldsUnidad = array(/* hoja vida */
            unidadMedidaTableClass::ID,
            unidadMedidaTableClass::DESCRIPCION
        );
        $orderByUnidad = array(
            unidadMedidaTableClass::DESCRIPCION
        );
        $this->objUnidadMedida = unidadMedidaTableClass::getAll($fieldsUnidad, true, $orderByUnidad, 'ASC');


//                $this->id_salida_bodega =  request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::SALIDA_BODEGA_ID, true));/*manda el id a la vista*/
        $this->defineView('edit', 'detalleHoja', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */


//                 log::register('editar',  detalleHojaTableClass::getNameTable());//linea de bitacora
      } else {
        routing::getInstance()->redirect('detalleHoja', 'index');
        session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
      }
    } catch (PDOException $exc) {

      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}

//echo '$ ' . number_format($precio, 0, ',', '.');
