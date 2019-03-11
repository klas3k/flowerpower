<?php
include 'framework\config.php';

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
    $myDispatcher = new \framework\control\ControlDispatcher($control, $action);
    $myDispatcher->execute();
} 
catch (\framework\error\FrameworkException $ex)
{  
        $myDispatcher = new \framework\control\ControlDispatcher(DEFAULT_ROLE, "default");
        $myDispatcher->execute();  
}