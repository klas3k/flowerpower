<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 4-1-2018
 * Time: 12:32
 */

namespace AppBundle\bestelApp\model\db;


use framework\model\Entiteit;

class Filiaal extends Entiteit
{
    private $id;
    private $vestiging;
    private $adres;
    private $postcode;
    private $vestigingsplaats;

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
    public function getVestiging()
    {
        return $this->vestiging;
    }

    /**
     * @return mixed
     */
    public function getAdres()
    {
        return $this->adres;
    }

    /**
     * @return mixed
     */
    public function getPostcode()
    {
        return $this->postcode;
    }

    /**
     * @return mixed
     */
    public function getVestigingsplaats()
    {
        return $this->vestigingsplaats;
    }

    /**
     * @return mixed
     */
    public function getTelefoonnummer()
    {
        return $this->telefoonnummer;
    }
    private $telefoonnummer;

}