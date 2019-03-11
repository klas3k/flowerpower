<?php
namespace AppBundle\bestelApp\control;

/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 3-1-2018
 * Time: 17:02
 */

use \framework\control\AbstractController  as    AbstractController;

class BezoekerController extends AbstractController
{
    function __construct($control, $action)

    {

        parent::__construct($control, $action); ;
    }

    function defaultAction()
    {
        $this->view->set("link","default");
    }
    function aanbodAction()
    {

        $this->view->set("aanbod",$this->model->getAanbod());
        $this->view->set("link","aanbod");
    }
    function filialenAction()
    {
        $this->view->set("filialen", $this->model->getFilialen());
        $this->view->set("link","filialen");
    }
    function inloggenAction()
    {
        $this->view->set('link','inloggen');
        if($this->model->isPostLeeg())
        {
            $this->view->set("info","Voer uw gegevens in en maak gebruik van de mogelijkheden om een bos bloemen te bestellen.");
        }
        else{
            $gebruiker = $this->model->controleerGebruiker();
            switch ($gebruiker)
            {
                case REQUEST_SUCCES:$this->forward("default", $this->model->getGebruiker()->getRole());break;
                case REQUEST_FAILURE_DATA_INCOMPLETE:$this->view->set("info","Er ontbreken gegevens, probeer het opnieuw!");break;
                case REQUEST_FAILURE_DATA_INVALID:$this->view->set("info","De ingevoerde gegevens zijn niet gevonden!");break;
            }
        }


    }
    function contactAction()
    {
        $this->forward("filialen");
    }
    function bestellenAction()
    {
        $this->view->set('link','bestellen');
    }

}