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
 * @author Julian Lasso <ingeniero.julianlasso@gmail.com>
 */
class createActionClass extends controllerClass implements controllerActionInterface {

  public function execute() {
    try {
      if (request::getInstance()->isMethod('POST')) {

        $updatedAt = request::getInstance()->getPost(usuTableClass::getNameField(usuTableClass::UPDATED_AT, true));
        $usuarioId = request::getInstance()->getPost(usuTableClass::getNameField(usuTableClass::USUARIO_ID, true));
        $credencialId = request::getInstance()->getPost(usuTableClass::getNameField(usuTableClass::CREDENCIAL_ID, true));

//   if (strlen($updateAt) > usuTableClass::UPDATE_AT) {
//       throw new PDOException(i18n::__(00001, null, 'errors', array(':longitud' => usuTableClass::NOMBRE_LENGTH)), 00001);
//    }
//   }

        $data = array(
            usuTableClass::UPDATED_AT => $updatedAt,
            usuTableClass::USUARIO_ID => ($usuarioId),
            usuTableClass::CREDENCIAL_ID => ($credencialId),
            usuTableClass::CREATED_AT => date(config::getFormatTimestamp())
        );
        usuTableClass::insert($data);
        routing::getInstance()->redirect('usuarioCredencial', 'index');
      } else {
        routing::getInstance()->redirect('usuarioCredencial', 'index');
      }
    } catch (PDOException $exc) {
      echo $exc->getMessage();
      echo '<br>';
      echo $exc->getTraceAsString();
    }
  }

}
