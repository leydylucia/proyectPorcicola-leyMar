<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log; /* linea de la bitacora */

/**
 *  Description of createActionClass esta clase sirve para 
 *  el create carge datos de la tabla y cumple con la funcion de insertar
 *
 * @author Leydy Lucia Castillo Mosquera <leydylucia@hotmail.com>
 * @category modulo sacrificio venta
 */
class graficaActionClass extends controllerClass implements controllerActionInterface {
    /* public function execute inicializa las returniables 
     * @return $valor=> valor
     * @return $tipoVenta=> tipo venta
     * @return $idCerdo=> id cerdo
     * * todas estos datos se pasa en la varible @var $data

     * ** */

    public function execute() {
        try {
            
            $this->cosPoints = array(
                rand(0, 10),
                rand(0, 10)
            );
            
            
            $this->defineView('grafica', 'sacrificioVenta', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
