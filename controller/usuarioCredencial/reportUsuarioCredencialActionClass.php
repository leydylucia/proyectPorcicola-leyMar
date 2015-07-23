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
 * @author Leydy Lucia Castillo <leydylucia@hotmail.com>
 * @category usuarioCredenial
 * @var $filter para hacer filtros,$where
 */
class reportUsuarioCredencialActionClass extends controllerClass implements controllerActionInterface {

    public function execute() {
        try {
            $where = null;
            if (request::getInstance()->hasPost('filter')) {
                $filter = request::getInstance()->getPost('filter');

                if (isset($filter['Usuario']) and $filter['Usuario'] !== null and $filter['Usuario'] !== '') {
                    $where[usuarioCredencialTableClass::USUARIO_ID] = $filter['Usuario'];
                }
                if (isset($filter['Credencial']) and $filter['Credencial'] !== null and $filter['Credencial'] !== '') {
                    $where[usuarioCredencialTableClass::CREDENCIAL_ID] = $filter['Credencial'];
                }


                /* para mantener filtro con paginado */
//                print_r($where);
//              echo  $filter['Date2'];
//                exit();
                session::getInstance()->setAttribute('defaultIndexFilters', $where);
            } elseif (session::getInstance()->hasAttribute('defaultIndexFilters')) {
                $where = session::getInstance()->getAttribute('defaultIndexFilters');
            }




            $fields = array(
                usuarioCredencialTableClass::ID,
                usuarioCredencialTableClass::USUARIO_ID,
                usuarioCredencialTableClass::CREDENCIAL_ID
            );
            $orderBy = array(
                usuarioCredencialTableClass::USUARIO_ID
            );





            /** @var $where => para filtros
             * *@var $page => para el paginado
             * *@var $fileds => para declarar los cmpos de la table en la bd
             * @var $orderBy => ordernar por el campo deseado
             *  true=> es el borrado logico si lo tienes en la bd pones true sino false
             * ASC => es la forma como se va a ordenar si de forma ascendente o desendente
             * config::getRowGrid()=> va con el paginado y hace una funcion
             * @var $this->objInsumo para enviar los datos a la vista      */
            $this->objUsuarioCredencial = usuarioCredencialTableClass::getAll($fields, false, $orderBy, 'ASC', null, null, $where);

            //estos campo son para llamar las foraneas
            $fields = array(/* foranea de usuario */
                usuarioTableClass::ID,
                usuarioTableClass::USER
            );
            $orderBy = array(
                usuarioTableClass::USER
            );
            $this->objUsuario = usuarioTableClass::getAll($fields, true, $orderBy, 'ASC');

            $fieldsCredencial = array(/* foranea credencial */
                credencialTableClass::ID,
                credencialTableClass::NOMBRE
            );
            $orderByCredencial = array(
                credencialTableClass::NOMBRE
            );
            $this->objCredencial = credencialTableClass::getAll($fieldsCredencial, true, $orderByCredencial, 'ASC');

            $this->defineView('indexUsuarioCredencial', 'usuarioCredencial', session::getInstance()->getFormatOutput());
        } catch (PDOException $exc) {
            session::getInstance()->setFlash('exc', $exc);
            routing::getInstance()->forward('shfSecurity', 'exception');
        }
    }

}
