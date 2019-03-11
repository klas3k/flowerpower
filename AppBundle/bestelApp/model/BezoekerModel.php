<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 3-1-2018
 * Time: 19:15
 */

namespace AppBundle\bestelApp\model;


class BezoekerModel extends \framework\model\AbstractModel
{
    function __construct($control, $action)
    {

        parent::__construct($control, $action);
    }

    function controleerGebruiker()
    {
        $gebruikersnaam = filter_input(INPUT_POST, "gn");
        $wachtwoord = filter_input(INPUT_POST, "pw");
        if (!isset($gebruikersnaam) || !isset($wachtwoord)) {
           return REQUEST_FAILURE_DATA_INCOMPLETE;
        } else {
            $sql = "SELECT * FROM personen WHERE gebruikersnaam = :gn AND wachtwoord = :pw LIMIT 1";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":gn", $gebruikersnaam);
            $query->bindParam(":pw", $wachtwoord);
            $query->execute();
            $gebruikers = $query->fetchAll(\PDO::FETCH_CLASS, BASE_NAMESPACE . "model\db\Persoon");

            if (count($gebruikers) == 0) {
                return REQUEST_FAILURE_DATA_INVALID;
            } else {
                $this->startSession();
                $this->setGebruiker($gebruikers[0]);
                return REQUEST_SUCCES;
            }
        }
    }
    function setGebruiker($gebruiker)
    {
        $_SESSION['gebruiker'] = $gebruiker;
    }


}