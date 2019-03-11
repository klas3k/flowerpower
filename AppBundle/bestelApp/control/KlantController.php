<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 6-1-2018
 * Time: 15:45
 */

namespace AppBundle\bestelApp\control;


use framework\control\AbstractController;


class KlantController extends AbstractController
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
    function bestellenAction()
    {
        $this->view->set("gebruiker",$this->model->getGebruiker());
        $this->view->set("link","bestellingen");
        $artikel = $this->model->getArtikel();

        if($artikel !== REQUEST_FAILURE_DATA_INVALID && $artikel !== DB_NOT_ACCEPTABLE_DATA)
        {
            $this->view->set("artikel", $artikel);
            if ($this->model->isPostLeeg()) {

                $this->view->set("info", "Geef op hoeveel bossen u wilt bestellen.");
            }
            else
            {
                $result = $this->model->bestellen();
                switch ($result)
                {
                    case REQUEST_SUCCES:
                        $this->forward("winkelwagen", "klant");

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
        else
        {
            $this->forward('aanbod');
        }
    }
    function aanbodAction()
    {
        $this->view->set("gebruiker",$this->model->getGebruiker());
        $this->view->set("aanbod",$this->model->getAanbod());
        $this->view->set("link","aanbod");
    }
    function winkelwagenAction()
    {
        $this->view->set("gebruiker",$this->model->getGebruiker());
        $this->view->set("winkels",$this->model->getFilialen());
        $ww = $this->model->getWinkelwagen();
        if ($ww === REQUEST_FAILURE_DATA_INCOMPLETE)
        {
            $this->view->set("info","U heeft nog geen producten geselecteerd in de winkelwagen!");
        }
        else
        {
            if(!$this->model->isPostLeeg()&& $this->model->isGerechtigd())
            {
                $verwerking = $this->model->verwerkBestelling();

                if($verwerking === REQUEST_SUCCES)
                {
                    $this->view->set("info","Bestelling  geplaatst.");
                }
                elseif($verwerking===DB_NOT_ACCEPTABLE_DATA)
                {
                    $this->view->set("info","Bestelling niet geplaatst, selecteer een winkel en een datum.");
                }
                elseif($verwerking===REQUEST_FAILURE_DATA_INCOMPLETE)
                {
                    $this->view->set("info","Geen bewerking.");
                }
                else{
                    $this->forward("default");
                }
            }
            else{
                $this->view->set('bestelling',$ww);
                $this->view->set("info","Dit heeft u in de winkelwagen geplaatst. Selecteer een datum en een vestiging om de bestelling definitief te maken.");

            }
        }

        $this->view->set("link","winkelwagen");
    }
    function bestellingenAction()
    {
        $this->view->set("link", "bestellingen");
        $this->view->set("gebruiker", $this->model->getGebruiker());
        $bestellingen = $this->model->getBestellingen();

        if ($bestellingen === DB_NOT_ACCEPTABLE_DATA) {
            $this->view->set("info", "Er kunnen geen bestellingen getoond worden.");
        } else {
            $this->view->set("bestellingen", $bestellingen);
        }
    }


    protected function toonBestellingAction()
    {
        $this->view->set("link","bestellingen");
        $this->view->set("gebruiker",$this->model->getGebruiker());
        $bestelling=$this->model->getBestelling();
        $besteldeArtikelen = $this->model->getBesteldeArtikelen();

        if($bestelling === DB_NOT_ACCEPTABLE_DATA || $besteldeArtikelen===DB_NOT_ACCEPTABLE_DATA)

        {
            $this->view->set("info","Er kan geen bestelling getoond worden.");
        }
        else
        {
            $this->view->set("bestelling",$bestelling);
            $this->view->set("besteldeartikelen",$besteldeArtikelen);
        }
        }

}