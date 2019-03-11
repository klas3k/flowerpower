<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 6-1-2018
 * Time: 15:45
 */

namespace AppBundle\bestelApp\control;


use framework\control\AbstractController;


class AdminController extends AbstractController
{
    public function __construct($control, $action)
    {
        parent::__construct($control, $action);
    }

    function defaultAction()
    {
        $this->view->set("gebruiker" , $this->model->getGebruiker());
        $this->view->set("link", "default");
    }
    function uitloggenAction()
    {
        $this->model->loguit();
        $this->forward("default", "bezoeker");
    }
    function filialenBeheerAction()
    {
        $this->view->set("gebruiker",$this->model->getGebruiker());
        $this->view->set("link","filialen");
        if ($this->model->isPostLeeg()) {

            $this->view->set("info", "Pas de gegevens aan en sla het resultaat op.");
        }
        else
        {
            $result = $this->model->bestellen();
            switch ($result)
            {
                case REQUEST_SUCCES:
                    $this->forward("bestellingen");

                    break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:
                    $this->view->set("info", "Er ontbreken gegevens, graag aanvullen.");
                    break;
                case REQUEST_FAILURE_DATA_INVALID:
                    $this->view->set("info", "Er kloppen gegevens niet.");
                    break;
            }
        }


    }


}