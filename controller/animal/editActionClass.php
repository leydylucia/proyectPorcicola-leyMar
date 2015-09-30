<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\myConfigClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

//use hook\log\logHookClass as log;

/**
 * Description of editActionClass trae datos cuando tiene foraneas y cumplir con
 * el funcionamiento de modificar datos
 *
 * @author Alexandra Florez
 */
class editActionClass extends controllerClass implements controllerActionInterface {
  /* public function execute inicializa las variables 
   * @return $genero_id=> genero (bigint)
   * @return $fecha_nacimiento=> fecha nacimiento (date)
   * @return $estado_id=> estado (bigint)
   * @return $lote_id=> lote(bigint)
   * @return $raza_id=> raza(bigint)
   * @return $nombre_cerdo =>nombre del cerdo (varchar)
   * todas estos datos se pasa en la varible @var $data
   * ** */
  /* public function execute inicializa las variables 
   * @return $fields=> son los campos que trae de la base de datos
   * @return $this=> es el que lleva los datos a la vista
   * @return $orderBy=> es para dar orden ascendente o descendente de los datos que provienen de la base de datos
   * Todas estos datos se pasan en la variable @var $data 
   * ** */

  public function execute() {
    try {
      if (request::getInstance()->hasGet(hojaVidaTableClass::ID)) {
        $fields = array(
            hojaVidaTableClass::ID,
            hojaVidaTableClass::GENERO_ID,
            hojaVidaTableClass::FECHA_NACIMIENTO,
            hojaVidaTableClass::ESTADO_ID,
            hojaVidaTableClass::LOTE_ID,
            hojaVidaTableClass::RAZA_ID,
            hojaVidaTableClass::NOMBRE_CERDO
                //hojaVidaTableClass::ID_MADRE
        );

        $where = array(
            hojaVidaTableClass::ID => request::getInstance()->getGet(hojaVidaTableClass::ID)
        );
        $this->objHojaVida = hojaVidaTableClass::getAll($fields, true, null, null, null, null, $where);


        // para editar foraneas tabla genero
        $fieldsU = array(
            generoTableClass::ID,
            generoTableClass::DESCRIPCION
        );
        $orderByU = array(
            generoTableClass::DESCRIPCION
        );
        $this->objGenero = generoTableClass::getAll($fieldsU, true, $orderByU, 'ASC');
        //fin
        // para editar foraneas tabla estado
        $fields = array(
            estadoTableClass::ID,
            estadoTableClass::DESC_ESTADO
        );
        $orderBy = array(
            estadoTableClass::DESC_ESTADO
        );
        $this->objEstado = estadoTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        // para editar foraneas tabla lote
        $fields = array(
            loteTableClass::ID,
            loteTableClass::DESC_LOTE
        );
        $orderBy = array(
            loteTableClass::DESC_LOTE
        );
        $this->objLote = loteTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        // para editar foraneas tabla raza
        $fields = array(
            razaTableClass::ID,
            razaTableClass::DESC_RAZA
        );
        $orderBy = array(
            razaTableClass::DESC_RAZA
        );
        $this->objRaza = razaTableClass::getAll($fields, true, $orderBy, 'ASC');
        //fin
        // para editar foraneas tabla raza
//        $fieldy = array(
//            hojaVidaTableClass::ID_MADRE
//                    );
//        $orderBr = array(
//            hojaVidaTableClass::ID_MADRE
//        );
//        $this->objHojaVida = hojaVidaTableClass::getAll($fieldy, true, $orderBr, 'ASC');
        // fin

        $this->defineView('edit', 'animal', session::getInstance()->getFormatOutput());
        //session::getInstance()->setSuccess('El registro se modifico exitosamente');
//        log::register('insertar', hojaVidaTableClass::getNameTable());
      } else {
        routing::getInstance()->redirect('animal', 'index');
      }
    } catch (PDOException $exc) {
      session::getInstance()->setFlash('exc', $exc);
      routing::getInstance()->forward('shfSecurity', 'exception');
    }
  }

}
