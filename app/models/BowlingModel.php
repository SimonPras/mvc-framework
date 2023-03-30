<?php
class BowlingModel
{
  // Properties, fields
  private $db;
  public $helper;

  public function __construct()
  {
    $this->db = new Database();
  }


  public function getBowlings()
  {
    $sql = "SELECT  Bowling1.Voornaam
                     ,Bowling1.Tussenvoegsel
                     ,Bowling1.Achternaam
                     ,Bowling1.Mobiel
                     ,Bowling1.DatumInDienst
                     ,Bowling1.AantalSterren
                     ,Bowling1.Id
              FROM `Bowling1` 
              ORDER BY AantalSterren DESC;";
    $this->db->query($sql);
    $result = $this->db->resultSet();
    return $result;
  }

  public function getBowlingById($Id)
  {
    $sql = "SELECT  Bowling1.Voornaam
                        ,Bowling1.Tussenvoegsel
                        ,Bowling1.Achternaam
                        ,Bowling1.DatumInDienst
                        ,Bowling1.AantalSterren
                        FROM Bowling1 
                        WHERE Id = :Id;";
    $this->db->query($sql);
    $this->db->bind(':Id', $Id, PDO::PARAM_INT);
    $result = $this->db->single();
    return $result;
  }

  public function getGebruikteVoertuigen($Id)
  {
    $sql = "SELECT   TypeVoertuig.TypeVoertuig
                        ,Typevoertuig.Rijbewijscategorie
                        ,Voertuig.Type
                        ,Voertuig.Kenteken
                        ,Voertuig.Bouwjaar
                        ,Voertuig.Brandstof

                FROM    Bowling1
                INNER JOIN VoertuigBowling
                ON         VoertuigBowling.Bowling1Id = Bowling1.Id
                INNER JOIN Voertuig
                ON         VoertuigBowling.VoertuigId = Voertuig.Id
                INNER JOIN TypeVoertuig
                ON         Voertuig.TypeVoertuigId = TypeVoertuig.Id
                WHERE   Bowling1.Id = :Id
                ORDER BY TypeVoertuig.Rijbewijscategorie ASC";
    $this->db->query($sql);
    $this->db->bind(':Id', $Id, PDO::PARAM_INT);
    $result = $this->db->resultSet();
    return $result;
  }
  public function CreateAccount($results)
  {
    var_dump($results);

    $sql = "CALL `spAddAccount` (:typePersoonId, :voornaam, :tussenvoegsel, :achternaam, :roepnaam, :isVolwassen);";
    $this->db->query($sql);

    $this->db->bind(':typePersoonId', $_POST['typePersoonId'], PDO::PARAM_STR);
    $this->db->bind(':voornaam', $_POST['voornaam'], PDO::PARAM_STR);
    $this->db->bind(':tussenvoegsel', $_POST['tussenvoegsel'], PDO::PARAM_STR);
    $this->db->bind(':achternaam', $_POST['achternaam'], PDO::PARAM_STR);
    $this->db->bind(':roepnaam', $_POST['roepnaam'], PDO::PARAM_STR);
    $this->db->bind(':isVolwassen', $_POST['isVolwassen'], PDO::PARAM_STR);

    $result = $this->db->resultSet();
    return $result;
  }
  // public function ContactEdit($results)
  // {
  //   var_dump($results);

  //   $sql = "CALL `spAddAccount` (:firstname, :infix, :lastname, :dateOfBirth, :username, :password);";
  //   $this->db->query($sql);

  //   $this->db->bind(':firstname', $_POST['firstname'], PDO::PARAM_STR);
  //   $this->db->bind(':infix', $_POST['infix'], PDO::PARAM_STR);
  //   $this->db->bind(':lastname', $_POST['lastname'], PDO::PARAM_STR);
  //   $this->db->bind(':dateOfBirth', $_POST['dateOfBirth'], PDO::PARAM_STR);
  //   $this->db->bind(':username', $_POST['username'], PDO::PARAM_STR);
  //   $this->db->bind(':password', $_POST['password'], PDO::PARAM_STR);

  //   $result = $this->db->resultSet();
  //   return $result;
  // }
}
