<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 6-1-2018
 * Time: 15:55
 */

namespace AppBundle\bestelApp\model;


use framework\model\AbstractModel;

class AdminModel extends AbstractModel
{
    function __construct($control, $action)
    {
        parent::__construct($control, $action);
    }


    function getFiliaal()
    {
        $id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
        if(!isset($id) || $id=== false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        $sql="SELECT * FROM `filialen` WHERE id = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(":id",$id);
        $query->execute();
        $filiaal = $query->fetchAll(\PDO::FETCH_CLASS,BASE_NAMESPACE."model\db\Filiaal");
        if(count($filiaal>0))
        {
            return $filiaal[0];
        }
        else
        {
            return DB_NOT_ACCEPTABLE_DATA;
        }
    }



}