<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of indexInsumoActionClass trae datos para visualizarlos en vista indextemplated
 *
 * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * @category modulo insumo

 */
class indexActionClass extends controllerClass implements controllerActionInterface {

    /**
     * Description of ejemploClass
     *
     * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
     * 
     */
    public function execute() {
        try {

  /* filtros */
//            $where = null; /* where se encuentra nulo para entrar en la sentencia getall */
            $where[detalleHojaTableClass::HOJA_VIDA_ID] = request::getInstance()->getGet('detalle_hoja_hoja_vida_id');
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter'); /* $filter si se encuentra en la vista?? */

                if (isset($filter['Peso']) and $filter['Peso'] !== null and $filter['Peso'] !== '') {
                    $where[detalleHojaTableClass::PESO_CERDO] = $filter['Peso'];
                }
               
                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                    $where[detalleHojaTableClass::CREATED_AT] = array(
//                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
//                        date(config::getFormatTimestamp(), strtotime($filter['Date2']))
                        $filter['Date1'],
                        $filter['Date2']
                    );
                }
                /* para mantener filtro con paginado */
//                print_r($where);
//              echo  $filter['Date2'];
//                exit();
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }
            /*             * @var $fields trae los campos de model
             * @var $orderBy ordena con el tipo de datos seleccionado
             * @var page paginado
             */


            $fields = array(
                detalleHojaTableClass::ID,
                detalleHojaTableClass::PESO_CERDO,
                detalleHojaTableClass::UNIDAD_MEDIDA_ID,
                detalleHojaTableClass::HOJA_VIDA_ID,
                detalleHojaTableClass::INSUMO_ID,
                detalleHojaTableClass::DOSIS,
                detalleHojaTableClass::TIPO_INSUMO_ID,
                detalleHojaTableClass::CREATED_AT
            );
            $orderBy = array(
                detalleHojaTableClass::PESO_CERDO
            );

            $page = 0; /* paginado */
            if (request::getInstance()->hasGet('page')) {
                $this->page = request::getInstance()->getGet('page');
                $page = request::getInstance()->getGet('page') - 1;
                $page = $page * config::getRowGrid();
            }
            /* para mantener filtro con paginado,
             * @return $this para enviar al cntPages"contador de pagina" a la vista 
             * *getTotalPages => se encuentra en insumoTables class
             * * @var $where => para sostener el filtro con el paginado  */
            $this->cntPages = detalleHojaTableClass::getTotalPages(config::getRowGrid(), $where);
            // $page = request::getInstance()->getGet('page');
//            $where = null;
            if (request::getInstance()->hasGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true))) {
                $this->detalleHojaId = $detalleHojaId = request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true));
                $where = array(
                    detalleHojaTableClass::HOJA_VIDA_ID => $detalleHojaId
                );
            }
            /* where2 sirve para traer tan solo el dato de la cabezera */
            $where2 = null;
            if (request::getInstance()->hasGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true))) {
                //$this->objSalidaBodega = $objSalidaBodega = request::getInstance()->getGet(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, true));
                $where2 = array(
                    hojaVidaTableClass::ID => request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true))
                );
            }
            /**
             *  
             * @var $where => para filtros
             * @var $page => para el paginado
             * @var $fileds => para declarar los campos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true 
             * sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o 
             * desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      
             *
             * */
            $this->objDetalleHoja = detalleHojaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

            //estos campo son para llamar las foraneas
            $fields = array(/* foranea salidaBodega */
                hojaVidaTableClass::ID,
                hojaVidaTableClass::CREATED_AT,
                hojaVidaTableClass::GENERO_ID,
                hojaVidaTableClass::NOMBRE_CERDO,
                hojaVidaTableClass::FECHA_NACIMIENTO,
                hojaVidaTableClass::LOTE_ID,
                hojaVidaTableClass::ESTADO_ID,
                hojaVidaTableClass::RAZA_ID,
                hojaVidaTableClass::CREATED_AT
            );
            $orderBy = array(
                hojaVidaTableClass::ID,
            );
            $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where2);

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
            $this->objTipoIn = tipoInsumoTableClass::getAll($fieldsTipoInsumo, true, $orderByTipoInsumo, 'ASC');


            $fieldsUnidad = array(
                unidadMedidaTableClass::ID,
                unidadMedidaTableClass::DESCRIPCION
            );
            $orderByUnidad = array(
                unidadMedidaTableClass::DESCRIPCION
            );
            $this->objUnidadMedida = unidadMedidaTableClass::getAll($fieldsUnidad, true, $orderByUnidad, 'ASC');

//ECHO $id_salida_bodega;
//            if(request::getInstance()->hasPost('filter')){
////                     $detalleHojaId = request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::SALIDA_BODEGA_ID, true));
//                     $detalleHojaId = request::getInstance()->getPost(detalleHojaTableClass::getNameField(detalleHojaTableClass::SALIDA_BODEGA_ID, true));
//                   
//                     $detalle = array(
//detalleHojaTableClass::getNameField(detalleHojaTableClass::SALIDA_BODEGA_ID) => $detalleHojaId
//);
//                     print_r($detalleHojaId);
//
//                     $this->defineView('indexDetalleSalida', 'detalleHoja', session::getInstance()->getFormatOutput(), $detalle);
//                print_r($detalle);
//                }else{
            $this->detalleHojaId = request::getInstance()->getGet(detalleHojaTableClass::getNameField(detalleHojaTableClass::HOJA_VIDA_ID, true));
            $this->defineView('index', 'detalleHoja', session::getInstance()->getFormatOutput());
//            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
