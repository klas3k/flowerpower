<?php

namespace framework\model;
use PDOException;

abstract class AbstractModel
{
    protected $control;
    protected $action;
    protected $dbh;
    public function __construct($control,$action)
    {

        $this->control = $control;
        $this->action = $action;
        try {
            $this->dbh = new \PDO(DATA_SOURCE_NAME, DB_USERNAME, DB_PASSWORD);
        }
        catch(\PDOException $e){
            echo 'Connection failed: ' . $e->getMessage();
    }
        $this->dbh->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        $this->dbh->setAttribute(\PDO::ATTR_EMULATE_PREPARES, false);

        if($this->control !==  \DEFAULT_ROLE)
        {
            $this->startSession();
        }
    }
    
    public function getGebruiker()
    {
        if(!isset($_SESSION)||!isset($_SESSION['gebruiker']))
        {
            return null;
        }
        else
        {
            return $_SESSION['gebruiker'];
        }
    }
    
    public function isGerechtigd()
    {
        if(isset($_SESSION['gebruiker'])&&!empty($_SESSION['gebruiker']))
        {
            $gebruiker=$_SESSION['gebruiker'];

            if ($gebruiker->getRole() == $this->control)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
        else {
            return $this->control==='bezoeker';
        }   
    }
   
   
    
    protected function startSession() 
    {
        if(!isset($_SESSION))
        {
            session_start();
        }
    }
    
    public function loguit() 
    {
        if(isset($_SESSION))
        {
            $_SESSION = array();
            session_destroy();
        }  
    }
    function getFilialen()
    {
        $sql = "SELECT * from filialen";
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $result =$query->fetchAll(\PDO::FETCH_CLASS,BASE_NAMESPACE."model\db\Filiaal");
        return $result;
    }

    function isPostLeeg()
    {
        return empty($_POST);
    }

    function getAanbod()
    {
        $sql = "SELECT * from artikelen";
        $query = $this->dbh->prepare($sql);
        $query->execute();
        $result =$query->fetchAll(\PDO::FETCH_CLASS,BASE_NAMESPACE."model\db\Artikel");
        return $result;
    }



}
