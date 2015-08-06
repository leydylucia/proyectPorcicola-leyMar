<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
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
class indexDetalleSalidaActionClass extends controllerClass implements controllerActionInterface {

    /**
     * Description of ejemploClass
     *
     * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
     * 
     */
    public function execute() {
        try {


            /* filtros */
            //$where = null; /* where se encuentra nulo para entrar en la sentencia getall */
            $where[detalleSalidaTableClass::SALIDA_BODEGA_ID] = request::getInstance()->getGet('detalle_salida_salida_bodega_id');
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter'); /* $filter si se encuentra en la vista?? */

                if (isset($filter['Cantidad']) and $filter['Cantidad'] !== null and $filter['Cantidad'] !== '') {
                    $where[detalleSalidaTableClass::CANTIDAD] = $filter['Cantidad'];
                }
                if (isset($filter['SalidaBodega']) and $filter['SalidaBodega'] !== null and $filter['SalidaBodega'] !== '') {
                    $where[detalleSalidaTableClass::SALIDA_BODEGA_ID] = $filter['SalidaBodega'];
                }

                if (isset($filter['Insumo']) and $filter['Insumo'] !== null and $filter['Insumo'] !== '') {
                    $where[detalleSalidaTableClass::INSUMO_ID] = $filter['Insumo'];
                }
                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                    $where[insumoTableClass::CREATED_AT] = array(
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

//            echo '<pre>';
//            print_r($where);esto es para imprimir filtros
//            echo '</pre>';

            /*             * @var $fields trae los campos de model
             * @var $orderBy ordena con el tipo de datos seleccionado
             * @var page paginado
             */


            $fields = array(
                detalleSalidaTableClass::ID,
                detalleSalidaTableClass::CANTIDAD,
                detalleSalidaTableClass::SALIDA_BODEGA_ID,
                detalleSalidaTableClass::INSUMO_ID,
                detalleSalidaTableClass::CREATED_AT
            );
            $orderBy = array(
                detalleSalidaTableClass::CANTIDAD
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
            $this->cntPages = detalleSalidaTableClass::getTotalPages(config::getRowGrid(), $where);
            // $page = request::getInstance()->getGet('page');
//            echo '<pre>';
//            print_r($where);esto es para imprimir filtros
//            echo '</pre>';
//            
//            $where = null;
//            if (request::getInstance()->hasGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true))) {
//                $this->detalleSalidaId = $detalleSalidaId = request::getInstance()->getGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true));
//                $where = array(
//                    detalleSalidaTableClass::SALIDA_BODEGA_ID => $detalleSalidaId
//                );
//            }
            $where2 = null;
            if (request::getInstance()->hasGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true))) {
                //$this->objSalidaBodega = $objSalidaBodega = request::getInstance()->getGet(salidaBodegaTableClass::getNameField(salidaBodegaTableClass::ID, true));
                $where2 = array(
                    salidaBodegaTableClass::ID => request::getInstance()->getGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true))
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
//            echo '<pre>';esto es para imprimir filtros
//            print_r($where);
//            echo '</pre>';

            $this->objDetalleSalida = detalleSalidaTableClass::getAll($fields, true, $orderBy, 'ASC', config::getRowGrid(), $page, $where);

//            echo '<pre>';
//            print_r($this->objDetalleSalida);esto es para imprimir filtros
//            echo '</pre>';
            //estos campo son para llamar las foraneas
            $fields = array(/* foranea salidaBodega */
                salidaBodegaTableClass::ID,
                salidaBodegaTableClass::CREATED_AT,
                salidaBodegaTableClass::EMPLEADO_ID
            );
            $orderBy = array(
                salidaBodegaTableClass::ID,
            );
            $this->objSalidaBodega = salidaBodegaTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where2);

            $fieldsInsumo = array(/* foranea insumo */
                insumoTableClass::ID,
                insumoTableClass::DESC_INSUMO
            );
            $orderByInsumo = array(
                insumoTableClass::DESC_INSUMO
            );
            $this->objInsumo = insumoTableClass::getAll($fieldsInsumo, true, $orderByInsumo, 'ASC');
//ECHO $id_salida_bodega;
//            if(request::getInstance()->hasPost('filter')){
////                     $detalleSalidaId = request::getInstance()->getGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true));
//                     $detalleSalidaId = request::getInstance()->getPost(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true));
//                   
//                     $detalle = array(
//detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID) => $detalleSalidaId
//);
//                     print_r($detalleSalidaId);
//
//                     $this->defineView('indexDetalleSalida', 'detalleSalida', session::getInstance()->getFormatOutput(), $detalle);
//                print_r($detalle);
//                }else{
            $this->detalleSalidaId = request::getInstance()->getGet(detalleSalidaTableClass::getNameField(detalleSalidaTableClass::SALIDA_BODEGA_ID, true));
            $this->defineView('indexDetalleSalida', 'detalleSalida', session::getInstance()->getFormatOutput());
//            }
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
