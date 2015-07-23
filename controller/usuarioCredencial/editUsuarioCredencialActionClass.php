<?php

use mvc\interfaces\controllerActionInterface;
use mvc\controller\controllerClass;
use mvc\config\configClass as config;
use mvc\request\requestClass as request;
use mvc\routing\routingClass as routing;
use mvc\session\sessionClass as session;
use mvc\i18n\i18nClass as i18n;

use hook\log\logHookClass as log;/*linea de la bitacora*/

/**
 * Description of ejemploClass
 *
 * @author leydy lucia castillo moaquera
 *  @category modulo insumo
 * 
 */
class editUsuarioCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            if (request::getInstance()->hasGet(usuarioCredencialTableClass::ID)) {
                $fields = array(
                    usuarioCredencialTableClass::ID,
                    usuarioCredencialTableClass::USUARIO_ID,
                    usuarioCredencialTableClass::CREDENCIAL_ID
                );
                $where = array(
                usuarioCredencialTableClass::ID => request::getInstance()->getGet(usuarioCredencialTableClass::ID)
                );
                $this->objUsuarioCredencial = usuarioCredencialTableClass::getAll($fields, false, null, null, null, null, $where);

                //estos campo son para llamar las foraneas
                $fields = array(/* foranea de usuario */
                    usuarioTableClass::ID,
                    usuarioTableClass::USER
                );
                $orderBy = array(
                    usuarioTableClass::USER
                );
                $this->objUsuario = usuarioTableClass::getAll($fields, false, $orderBy, 'ASC');/*@param fields , para campos,false=>es por borrado logico como no tiene eliminado se agrega el false */

                $fieldsCredencial = array(/* foranea credencial */
                    credencialTableClass::ID,
                    credencialTableClass::NOMBRE
                );
                $orderByCredencial = array(
                    credencialTableClass::NOMBRE
                );
                $this->objCredencial = credencialTableClass::getAll($fieldsCredencial, true, $orderByCredencial, 'ASC');

                $this->defineView('editUsuarioCredencial', 'usuarioCredencial', session::getInstance()->getFormatOutput()); /* en caso de no funcionar addicionar en edit editInsumo */


                 log::register('editar',  usuarioCredencialTableClass::getNameTable());//linea de bitacora
            } else {
                routing::getInstance()->redirect('usuarioCredencial', 'indexUsuarioCredencial');
                session::getInstance()->setSuccess('el registro se modifico exitosamente'); /* mensaje de exito */
            }
        } catch (PDOException $exc) {

            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}

//echo '$ ' . number_format($precio, 0, ',', '.');
