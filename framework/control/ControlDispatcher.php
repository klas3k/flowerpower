<?php

namespace framework\control;
class ControlDispatcher 
{
    
    private $control;
    private $action;
    public function __construct($control, $action)
    {
        $this->control = strtolower(trim($control));
        $this->action = strtolower(trim($action));
    }
    public function execute()
    {

        $klasseNaam = BASE_NAMESPACE.'control\\'.ucFirst($this->control).'Controller';

        if(!class_exists($klasseNaam))
        {
            throw new \framework\error\FrameworkException
                                    ("klas $klasseNaam bestaat niet!!!");  
        }

        if(!is_subclass_of($klasseNaam,'\\framework\\control\\IController'))
        {
            throw new framework\error\FrameworkException
                        ("klas $klasseNaam implementeert framework \\framework\\control\\IController niet");
        }
        $controller = new $klasseNaam($this->control,$this->action);

        $controller->execute();
    }
}






