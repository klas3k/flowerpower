<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 6-1-2018
 * Time: 15:21
 */

namespace AppBundle\bestelApp\model\db;


use framework\model\Entiteit;

class Persoon extends Entiteit
{
    private $id;
    private $voornaam;
    private $tussenvoegsel;
    private $achternaam;
    private $gebruikersnaam;
    private $wachtwoord;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getVoornaam()
    {
        return $this->voornaam;
    }

    /**
     * @return mixed
     */
    public function getTussenvoegsel()
    {
        return $this->tussenvoegsel;
    }

    /**
     * @return mixed
     */
    public function getAchternaam()
    {
        return $this->achternaam;
    }

    /**
     * @return mixed
     */
    public function getGebruikersnaam()
    {
        return $this->gebruikersnaam;
    }

    /**
     * @return mixed
     */
    public function getWachtwoord()
    {
        return $this->wachtwoord;
    }

    /**
     * @return mixed
     */
    public function getRole()
    {
        return $this->role;
    }
    private $role;
}