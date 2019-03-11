<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 4-1-2018
 * Time: 11:27
 */

namespace AppBundle\bestelApp\model\db;


use framework\model\Entiteit;

class Artikel extends Entiteit
{
    private $id;
    private $omschrijving;
    private $prijs;
    private $voorraad ;
    private $aantal=null;

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
    public function getOmschrijving()
    {
        return $this->omschrijving;
    }

    /**
     * @return mixed
     */
    public function getPrijs()
    {
        return $this->prijs;
    }

    /**
     * @return mixed
     */
    public function getVoorraad()
    {
        return $this->voorraad;
    }

    /**
     * @return null
     */
    public function getAantal()
    {
        return $this->aantal;
    }



}