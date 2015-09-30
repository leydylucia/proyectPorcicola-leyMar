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
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo detallSalida
 */
class editDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $cantidad=> cantidad (bigint)
   * @return $salida_bodega=> salida bodega (bigint)
   * @return $insumo=>  insumo (bigint)
   * @return $unidad_medida=> unidad medida(bigint)
   * @return $lote=> lote(bigint)
   * todas estos datos se pasa en la varible @var $data
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->hasGet(detalleSalidaTableClass::ID)) {
        $fields = array(
            detalleSalidaTableClass::ID,
            detalleSalidaTableClass::CANTIDAD,
            detalleSalidaTableClass::SALIDA_BODEGA_ID,
            detalleSalidaTableClass::INSUMO_ID,
            detalleSalidaTableClass::UNIDAD_MEDIDA_ID,
            detalleSalidaTableClass::LOTE_ID,
        );
        $where = array(
            detalleSalidaTableClass::ID => request::getInstance()->getGet(detalleSalidaTableClass::ID)
        );
        $this->objDetalleSalida = detalleSalidaTableClass::getAll($fields, true, null, null, null, null, $where);

        //estos campo son para llamar las foraneas
        $fields = array(/* foranea salidaBodega */
            salidaBodegaTableClass::ID,
        );
        $orderBy = array(
            salidaBodegaTableClass::ID,
        );
        $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, true, $orderBy, 'ASC');

        $fieldsInsumo = array(/* foranea insumo */
            insumoTableClass::ID,
            insumoTableClass::DESC_INSUMO
        );
        $orderByInsumo = array(
            insumoTableClass::DESC_INSUMO
        );
        $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');

        $fieldsUnidad = array(
            unidadMedidaTableClass::ID,
            unidadMedidaTableClass::DESCRIPCION
        );
        $orderByUnidad = array(
            unidadMedidaTableClass::DESCRIPCION
        );
        $this->objUnidadMedida = unidadMedidaTableClass::getAll($fieldsUnidad, true, $orderByUnidad, 'ASC');

        $fieldsLote = array(
            loteTableClass::ID,
            loteTableClass::DESC_LOTE
        );
        $orderByLote = array(
            loteTableClass::DESC_LOTE
        );
        $this->objLote = loteTableClass::getAll($fieldsLote, true, $orderByLote, 'ASC');

        $this->id_salida_bodega = request::getInstance()->getGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true)); /* manda el id a la vista */
        $this->defineView('editDetalleSalida', 'detalleSalida', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */


//                 log::register('editar',  detalleSalidaTableClass::getNameTable());//linea de bitacora
      } else {
        routing::getInstance()->redirect('detalleSalida', 'indexDetalleSalida');
        session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
      }
    } catch (PDOException $exc) {

      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}

//echo '$ ' . number_format($precio, 0, ',', '.');
