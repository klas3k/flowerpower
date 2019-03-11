<?php
/**
 * Created by PhpStorm.
 * User: KOOH02
 * Date: 6-1-2018
 * Time: 15:55
 */

namespace AppBundle\bestelApp\model;


use framework\model\AbstractModel;

class Klantmodel extends AbstractModel
{
    function __construct($control, $action)
    {
        parent::__construct($control, $action);
    }
    public function bestellen()
    {
        $id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
        $aantal=filter_input(INPUT_POST,"aantal",FILTER_VALIDATE_INT);
        $klant = $this->getGebruiker()->getId();

        if(isset($id)&& isset($aantal) && $this->isGerechtigd())
        {
            if(!$id===false && !$aantal === false   )
            {
                if(!isset($_SESSION['bestelnummer'])) {
                    $sql = "INSERT into `bestellingen` (psn_kl_id) VALUES (:klant)";
                    $query = $this->dbh->prepare($sql);
                    $query->bindParam(":klant", $klant);
                    //$query->bindParam(":datum", $datum);
                    //$query->bindParam(":winkel", $winkel);
                    $query->execute();
                    $sql1 = "SELECT MAX(id) as max FROM bestellingen WHERE psn_kl_id = :klant";
                    $query1 = $this->dbh->prepare($sql1);
                    $query1->bindParam(":klant", $klant);
                    $query1->execute();
                    $result = $query1->fetch(\PDO::FETCH_ASSOC);
                    if (!($result === false)) {
                        /* bestelling wordt opgeslagen in session */
                        $_SESSION['bestelnummer'] = $result['max'];
                    } else {
                        return DB_NOT_ACCEPTABLE_DATA;
                    }

                }
               $bsg_id = $_SESSION['bestelnummer'];
               $sql2 = "INSERT into `bestelregels` (bsg_id,atl_id,aantal) VALUES(:bsg_id, :atl_id, :aantal)";
               $query2 = $this->dbh->prepare($sql2);
               $query2->bindParam(":bsg_id", $bsg_id);
               $query2->bindParam(":atl_id",$id);
               $query2->bindParam(":aantal",$aantal);
               $query2->execute();
               if( $query2===1)
               {
                   return REQUEST_SUCCES;
               }
            }
            else{
                return REQUEST_FAILURE_DATA_INVALID;
            }

        }
        else
        {
            return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
    }
    public function getArtikel()
    {
        $id = filter_input(INPUT_GET,"id",FILTER_VALIDATE_INT);
        if(!isset($id) || $id=== false)
        {
            return REQUEST_FAILURE_DATA_INVALID;
        }
        $sql="SELECT * FROM `artikelen` WHERE id = :id";
        $query = $this->dbh->prepare($sql);
        $query->bindParam(":id",$id);
        $query->execute();
        $artikel = $query->fetchAll(\PDO::FETCH_CLASS,BASE_NAMESPACE."model\db\Artikel");
        if(count($artikel)>0)
        {
            return $artikel[0];
        }
        else
        {
            return DB_NOT_ACCEPTABLE_DATA;
        }
    }
    public function getWinkelwagen()
    {
        if(isset($_SESSION['bestelnummer']) && $this->isGerechtigd())
        {

                $sql="SELECT a.omschrijving, b.aantal, a.prijs FROM `bestelregels` as b  JOIN `artikelen` as a ON b.atl_id = a.id WHERE b.bsg_id = :bestelnummer AND b.besteld = 0 ";
                $query = $this->dbh->prepare($sql);
                $query->bindParam(":bestelnummer",$_SESSION['bestelnummer']);
                $query->execute();
                if(!$query===false)
                {
                    $result = $query->fetchAll(\PDO::FETCH_CLASS,BASE_NAMESPACE."model\db\Bestelregel");
                    return $result;
                }
                else
                {
                    return REQUEST_FAILURE_DATA_INCOMPLETE;
                }

        }
        else
        {
         return REQUEST_FAILURE_DATA_INCOMPLETE;
        }
    }

    public function verwerkBestelling()
    {
        $datum = filter_input(INPUT_POST,"datum");
        $winkel = filter_input(INPUT_POST,"winkel", FILTER_VALIDATE_INT);
        $id = $_SESSION['bestelnummer'];
        if(isset($datum) && isset($winkel) && $this->isGerechtigd())
        {
            $sql = "UPDATE `bestellingen` SET datum=:datum,  wkl_id= :winkel  WHERE id = :id ";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":datum",$datum);
            $query->bindParam(":winkel",$winkel);
            $query->bindParam(":id",$id);
            $verwerking = $query->execute();
            $sql = "UPDATE `bestelregels` SET besteld=1  WHERE bsg_id = :id ";
            $query = $this->dbh->prepare($sql);
            $query->bindParam(":id",$id);
            $result = $query->execute();

           if($verwerking===true && $result === true)
            {

                    return REQUEST_SUCCES;
            }
            else{
                return DB_NOT_ACCEPTABLE_DATA;
            }


        }
        return REQUEST_FAILURE_DATA_INCOMPLETE;
    }

    function getBestellingen()
    {
        $id = $this->getGebruiker()->getId();
        $sql = "SELECT * FROM `bestellingen`  WHERE psn_kl_id = :id AND datum > CURRENT_TIMESTAMP ";
        $query = $this->dbh->prepare($sql);

        $query->bindParam(":id",$id);
        $query->execute();
        $bestellingen = $query->fetchAll(\PDO::FETCH_CLASS,BASE_NAMESPACE."model\db\Bestelling");
        if ( $bestellingen !== false && count($bestellingen )> 0)
        {
            return $bestellingen;
        }
        else
        {
            return DB_NOT_ACCEPTABLE_DATA;
        }
    }
    function getBestelling()
    {
        $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        $sql = "SELECT * FROM `bestellingen`  WHERE id = :id  ";
        $query = $this->dbh->prepare($sql);

        $query->bindParam(":id",$id);
        $query->execute();
        $bestelling = $query->fetchAll(\PDO::FETCH_CLASS,BASE_NAMESPACE."model\db\Bestelling");
        if ( $bestelling !== false && count($bestelling )> 0)
        {
            return $bestelling[0];
        }
        else
        {
            return DB_NOT_ACCEPTABLE_DATA;
        }
    }

    function getBesteldeArtikelen()
    {
        $id = filter_input(INPUT_GET,'id',FILTER_VALIDATE_INT);
        $sql = "SELECT a.id, a.omschrijving, a.prijs, a.voorraad, b.aantal FROM `artikelen` a  JOIN `bestelregels` b ON a.id = b.atl_id WHERE b.`bsg_id` = :id ";
        $query = $this->dbh->prepare($sql);

        $query->bindParam(":id",$id);
        $query->execute();
        $artikelen = $query->fetchAll(\PDO::FETCH_CLASS,BASE_NAMESPACE."model\db\Artikel");
        if ( $artikelen !== false && count($artikelen )> 0)
        {
            return $artikelen;
        }
        else
        {
            return DB_NOT_ACCEPTABLE_DATA;
        }
    }
}