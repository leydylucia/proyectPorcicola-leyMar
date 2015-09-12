<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

/**
 * Description of ejemploClass
 *
 * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * * @category sacrificio venta
 * @var $filter para hacer filtros,$where
 */
class reportSacrificioVentaActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            /* filtros */
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['valor']) and $filter['valor'] !== null and $filter['valor'] !== '') {
                    $where[sacrificiovTableClass::VALOR] = $filter['valor'];
                }
                
                if (isset($filter['cantidad']) and $filter['cantidad'] !== null and $filter['cantidad'] !== '') {
                    $where[sacrificiovTableClass::CANTIDAD] = $filter['cantidad'];
                }

                if (isset($filter['Tipo_venta']) and $filter['Tipo_venta'] !== null and $filter['Tipo_venta'] !== '') {
                    $where[sacrificiovTableClass::TIPO_VENTA_ID] = $filter['Tipo_venta'];
                }
                
                 if (isset($filter['Cerdo']) and $filter['Cerdo'] !== null and $filter['Cerdo'] !== '') {
                    $where[sacrificiovTableClass::ID_CERDO] = $filter['Cerdo'];
                }

                if ((isset($filter['Date1']) and $filter['Date1'] !== null and $filter['Date1'] !== '') and ( isset($filter['Date2']) and $filter['Date2'] !== null and $filter['Date2'] !== '')) {
                    $where[proveedorTableClass::CREATED_AT] = array(
                        date(config::getFormatTimestamp(), strtotime($filter['Date1'])),
                        date(config::getFormatTimestamp(), strtotime($filter['Date2'])),
                    );
                }
                /* para mantener filtro con paginado */
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }



            $fields = array(
                sacrificiovTableClass::ID,
                sacrificiovTableClass::VALOR,
                sacrificiovTableClass::TIPO_VENTA_ID,
                sacrificiovTableClass::CANTIDAD,
                sacrificiovTableClass::UNIDAD_MEDIDA_ID,
                sacrificiovTableClass::ID_CERDO,
            );
            $orderBy = array(
                sacrificiovTableClass::VALOR
            );





            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      */
            $this->objSacrificioV = sacrificiovTableClass::getAll($fields, true, $orderBy, 'ASC', null, null, $where);

            //estos campo son para llamar las foraneas
            $fieldsa = array(
                tipovTableClass::ID,
                tipovTableClass::DESC_TIPOV
            );
            $orderBy = array(
                tipovTableClass::DESC_TIPOV
            );
            $this->objTipoV = tipovTableClass::getAll($fieldsa, true, $orderBy, 'ASC');

            $fieldsCerdo = array(/* foranea cerdo"hoja de vida" */
                hojaVidaTableClass::ID,
            );
            $orderByCerdo = array(
                hojaVidaTableClass::ID
            );
            $this->objHojaVida = hojaVidaTableClass::getAll($fieldsCerdo, true, $orderByCerdo, 'ASC');


            $this->defineView('index', 'sacrificioVenta', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
