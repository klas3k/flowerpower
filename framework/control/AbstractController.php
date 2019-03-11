<?php
namespace framework\control;
use \framework\error as ERROR;

abstract class AbstractController implements IController
{
    protected $control;
    protected $action; 
    protected $view;
    protected $model;
    
    public function __construct($control, $action){
        $this->control = $control;
        $this->action = $action;
        $this->view = new \framework\view\View();
        $modelClassName = BASE_NAMESPACE.'model\\'.ucfirst($this->control)."Model";

        if(!class_exists($modelClassName))
        {
            throw new ERROR\FrameworkException("klas $modelClassName bestaat niet!!!");  
        }
        if(!is_subclass_of($modelClassName,'framework\\model\\AbstractModel'))
        {
            throw new ERROR\FrameworkException
                        ("klas $modelClassName erft niet van framework AbstractModel");
        }
        $this->model = new $modelClassName($control, $action);

        $isGerechtigd = $this->model->isGerechtigd();

        
        if($isGerechtigd!=true)
        {
            $this->model->loguit();
            $this->forward('default','bezoeker');
        }
    }
    
    public function execute()
    {
        $opdracht = $this->action."Action";
        if(method_exists($this, $opdracht)){
            $this->$opdracht();
            $this->view->setAction($this->action);
            $this->view->setControl($this->control);
            $this->view->toon();
        }
        else {
            throw new ERROR\FrameworkException("onbekende methode aanroep");
        }
    }
    
    protected function forward($action, $control=null){
        $action = strtolower(trim($action));
        if(isset($control)){
            
            $klasseNaam = BASE_NAMESPACE.'control\\'.ucFirst($control).'Controller';
            if(!class_exists($klasseNaam))
            {
                throw new ERROR\FrameworkException("klas $klasseNaam bestaat niet!!!");  
            }
            if(!is_subclass_of($klasseNaam,'\\framework\\control\\AbstractController'))
            {
                throw new ERROR\FrameworkException
                            ("klas $klasseNaam erft niet van framework AbstractController");
            }
            $controller = new $klasseNaam($control,$action);
        }
        else{
            $controller = $this;
            $this->action = $action;
        }
        $controller->execute();
        exit();
    }
    protected abstract function defaultAction();
}


