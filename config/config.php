<?php

//use mvc\config\myConfigClass as config;
use mvc\config\myConfigClass as config;
use mvc\session\sessionClass as session;

config::setRowGrid(10);

config::setDbHost('localhost');
config::setDbDriver('pgsql'); // pgsql
config::setDbName('bdprueba');
config::setDbPort(5432); // 5432
config::setDbUser('postgres');
config::setDbPassword('123456');
// Esto solo es necesario en caso de necesitar un socket para la DB
// config::setDbUnixSocket(null);

if (config::getDbUnixSocket() !== null) {
  config::setDbDsn(
          config::getDbDriver()
          . ':unix_socket=' . config::getDbUnixSocket()
          . ';dbname=' . config::getDbName()
  );
} else {
  config::setDbDsn(
          config::getDbDriver()
          . ':host=' . config::getDbHost()
          . ';port=' . config::getDbPort()
          . ';dbname=' . config::getDbName()
  );
}

config::setPathAbsolute('/var/www/html/proyectPorcicola-leyMar/');

//host virtual
config::setUrlBase('http://www.porcicolatapasco.com/');
//fin hosting

//config::setUrlBase('http://192.168.43.58/proyectPorcicola-leyMar/web/');

config::setScope('dev'); // dev//prod

if (session::getInstance()->hasDefaultCulture() === false) {
  config::setDefaultCulture('es');
} else {
  config::setDefaultCulture(session::getInstance()->getDefaultCulture());
}

config::setIndexFile('index.php');

config::setFormatTimestamp('Y-m-d H:i:s');

config::setHeaderJson('Content-Type: application/json; charset=utf-8');
config::setHeaderXml('Content-Type: application/xml; charset=utf-8');
config::setHeaderHtml('Content-Type: text/html; charset=utf-8');
config::setHeaderPdf('Content-type: application/pdf; charset=utf-8');
config::setHeaderJavascript('Content-Type: text/javascript; charset=utf-8');
config::setHeaderExcel2003('Content-Type: application/vnd.ms-excel; charset=utf-8');
config::setHeaderExcel2007('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet; charset=utf-8');

config::setCookieNameRememberMe('mvcSiteRememberMe');
config::setCookieNameSite('mvcSite');
//host virtual
config::setCookiePath('/www.porcicolatapasco.com/web/' . config::getIndexFile());
//fin hosting


config::setCookiePath('/proyectPorcicola-leyMar/web/' . config::getIndexFile());

//host virtual
config::setCookieDomain('http://www.porcicolatapasco.com/');
//fin hosting

//config::setCookieDomain('http://192.168.43.58/');
config::setCookieTime(3600 * 8); // una hora en segundo 3600 y por 8 serían 8 horas

//config::setDefaultModule('default');
//config::setDefaultAction('index');

config::setDefaultModule('paginaPrincipal');
config::setDefaultAction('index');

config::setDefaultModuleSecurity('shfSecurity');
config::setDefaultActionSecurity('index');

config::setDefaultModulePermission('shfSecurity');
config::setDefaultActionPermission('noPermission');
