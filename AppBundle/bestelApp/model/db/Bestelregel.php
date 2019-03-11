<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 7-1-2018
 * Time: 9:03
 */

namespace AppBundle\bestelApp\model\db;


class Bestelregel
{
    private $omschrijving;
    private $aantal;
    private $prijs;


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
    public function getOmschrijving()
    {
        return $this->omschrijving;
    }

    /**
     * @return mixed
     */
    public function getAantal()
    {
        return $this->aantal;
    }

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
    public function getBsgId()
    {
        return $this->bsg_id;
    }

    /**
     * @return mixed
     */
    public function getAtlId()
    {
        return $this->atl_id;
    }



}