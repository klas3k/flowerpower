<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 6-1-2018
 * Time: 21:07
 */

namespace AppBundle\bestelApp\model\db;


class Bestelling
{
    private $id;
    private $psn_kl_id;
    private $psn_mw_id;
    private $wkl_id;
    private $datum;
    private $afgehaald;


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
    public function getPsnKlId()
    {
        return $this->psn_kl_id;
    }

    /**
     * @return mixed
     */
    public function getPsnMwId()
    {
        return $this->psn_mw_id;
    }

    /**
     * @return mixed
     */
    public function getWklId()
    {
        return $this->wkl_id;
    }

    /**
     * @return mixed
     */
    public function getDatum()
    {
        return $this->datum;
    }

    /**
     * @return mixed
     */
    public function getAfgehaald()
    {
        return $this->afgehaald;
    }




}