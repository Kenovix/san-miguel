<?php

//  define('SHOW_VARIABLES', 1);
//  define('DEBUG_LEVEL', 1);

//  error_reporting(E_ALL ^ E_NOTICE);
//  ini_set('display_errors', 'On');

set_include_path('.' . PATH_SEPARATOR . get_include_path());


include_once dirname(__FILE__) . '/' . 'components/utils/system_utils.php';

//  SystemUtils::DisableMagicQuotesRuntime();

SystemUtils::SetTimeZoneIfNeed('America/New_York');

function GetGlobalConnectionOptions()
{
    return array(
  'server' => 'localhost',
  'port' => '3306',
  'username' => 'root',
  'password' => 'root',
  'database' => 'sissg_dev'
);
}

function HasAdminPage()
{
    return false;
}

function GetPageInfos()
{
    $result = array();
    $result[] = array('caption' => 'Act Movimientos', 'short_caption' => 'Act Movimientos', 'filename' => 'act_movimientos.php', 'name' => 'act_movimientos');
    $result[] = array('caption' => 'Act Ordenes', 'short_caption' => 'Act Ordenes', 'filename' => 'act_ordenes.php', 'name' => 'act_ordenes');
    $result[] = array('caption' => 'Activos', 'short_caption' => 'Activos', 'filename' => 'activos.php', 'name' => 'activos');
    $result[] = array('caption' => 'Almacen', 'short_caption' => 'Almacen', 'filename' => 'almacen.php', 'name' => 'almacen');
    $result[] = array('caption' => 'Cartera', 'short_caption' => 'Cartera', 'filename' => 'cartera.php', 'name' => 'cartera');
    $result[] = array('caption' => 'Clasecuenta', 'short_caption' => 'Clasecuenta', 'filename' => 'clasecuenta.php', 'name' => 'clasecuenta');
    $result[] = array('caption' => 'Clientes', 'short_caption' => 'Clientes', 'filename' => 'clientes.php', 'name' => 'clientes');
    $result[] = array('caption' => 'Cod Departamentos', 'short_caption' => 'Cod Departamentos', 'filename' => 'cod_departamentos.php', 'name' => 'cod_departamentos');
    $result[] = array('caption' => 'Cod Municipios Dptos', 'short_caption' => 'Cod Municipios Dptos', 'filename' => 'cod_municipios_dptos.php', 'name' => 'cod_municipios_dptos');
    $result[] = array('caption' => 'Cod Paises', 'short_caption' => 'Cod Paises', 'filename' => 'cod_paises.php', 'name' => 'cod_paises');
    $result[] = array('caption' => 'Cuentas', 'short_caption' => 'Cuentas', 'filename' => 'cuentas.php', 'name' => 'cuentas');
    $result[] = array('caption' => 'Cuentasfrecuentes', 'short_caption' => 'Cuentasfrecuentes', 'filename' => 'cuentasfrecuentes.php', 'name' => 'cuentasfrecuentes');
    $result[] = array('caption' => 'Egresos', 'short_caption' => 'Egresos', 'filename' => 'egresos.php', 'name' => 'egresos');
    $result[] = array('caption' => 'Empresa', 'short_caption' => 'Empresa', 'filename' => 'empresa.php', 'name' => 'empresa');
    $result[] = array('caption' => 'Facturas', 'short_caption' => 'Facturas', 'filename' => 'facturas.php', 'name' => 'facturas');
    $result[] = array('caption' => 'Gupocuentas', 'short_caption' => 'Gupocuentas', 'filename' => 'gupocuentas.php', 'name' => 'gupocuentas');
    $result[] = array('caption' => 'Impret', 'short_caption' => 'Impret', 'filename' => 'impret.php', 'name' => 'impret');
    $result[] = array('caption' => 'Imv', 'short_caption' => 'Imv', 'filename' => 'imv.php', 'name' => 'imv');
    $result[] = array('caption' => 'Kardexmercancias', 'short_caption' => 'Kardexmercancias', 'filename' => 'kardexmercancias.php', 'name' => 'kardexmercancias');
    $result[] = array('caption' => 'Librodiario', 'short_caption' => 'Librodiario', 'filename' => 'librodiario.php', 'name' => 'librodiario');
    $result[] = array('caption' => 'Proveedores', 'short_caption' => 'Proveedores', 'filename' => 'proveedores.php', 'name' => 'proveedores');
    $result[] = array('caption' => 'Servicio', 'short_caption' => 'Servicio', 'filename' => 'servicio.php', 'name' => 'servicio');
    return $result;
}

function GetPagesHeader()
{
    return
    '';
}

function GetPagesFooter()
{
    return
        ''; 
    }

function ApplyCommonPageSettings(Page $page, Grid $grid)
{
    $page->SetShowUserAuthBar(false);
    $grid->BeforeUpdateRecord->AddListener('Global_BeforeUpdateHandler');
    $grid->BeforeDeleteRecord->AddListener('Global_BeforeDeleteHandler');
    $grid->BeforeInsertRecord->AddListener('Global_BeforeInsertHandler');
}

/*
  Default code page: 1252
*/
function GetAnsiEncoding() { return 'windows-1252'; }

function Global_BeforeUpdateHandler($page, $rowData, &$cancel, &$message, $tableName)
{

}

function Global_BeforeDeleteHandler($page, $rowData, &$cancel, &$message, $tableName)
{

}

function Global_BeforeInsertHandler($page, $rowData, &$cancel, &$message, $tableName)
{

}

function GetDefaultDateFormat()
{
    return 'Y-m-d';
}

function GetFirstDayOfWeek()
{
    return 0;
}

function GetEnableLessFilesRunTimeCompilation()
{
    return false;
}



?>