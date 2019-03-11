<?php
include 'framework\config.php';

/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 3-1-2018
 * Time: 17:31
 */
function __autoload($className)
{
$class = str_replace('\\',DIRECTORY_SEPARATOR,$className);
$file = "$class.php";
include_once $file;
}

$control = DEFAULT_ROLE;
if(isset($_REQUEST['control'])&&!empty($_REQUEST['control']))
{
    $control = $_REQUEST['control'];
}

$action = 'default';
if(isset($_REQUEST['action'])&&!empty($_REQUEST['action']))
{
    $action = $_REQUEST['action'];
}

try
{
    $myDispatcher = new framework\control\ControlDispatcher($control, $action);

    $myDispatcher->execute();
}
catch (framework\error\FrameworkException $ex)
{
    $myDispatcher = new framework\control\ControlDispatcher('bezoeker','default');

    $myDispatcher->execute();
}
?>
