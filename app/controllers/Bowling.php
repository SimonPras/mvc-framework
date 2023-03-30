<?php
class Bowling extends Controller
{
  // Properties, field
  private $bowlingModel;

  // Dit is de constructor
  public function __construct()
  {
    $this->bowlingModel = $this->model('BowlingModel');
  }

  public function index()
  {
    /**
     * Haal alle bowlings op uit de model
     */
    $bowlings = $this->bowlingModel->getBowlings();

    /**
     * Maak tabelrijen van de opgehaalde data over de bowlings
     */
    $rows = '';
    foreach ($bowlings as $value) {
      $rows .= "<tr>
                  <td>$value->Voornaam</td>
                  <td>$value->Tussenvoegsel</td>
                  <td>$value->Achternaam</td>
                  <td>$value->Mobiel</td>
                  <td>$value->DatumInDienst</td>
                  <td>$value->AantalSterren</td>
                  <td><a href='" . URLROOT . "/bowling/gebruiktevoertuigen/$value->Id'><i class='bi bi-car-front-fill'></i></a></td>
                </tr>";
    }

    /**
     * Stuur de informatie door naar de view
     */
    $data = [
      'title' => 'Bowlings in dienst',
      'amountOfBowlings' => sizeof($bowlings),
      'rows' => $rows
    ];
    $this->view('/bowling/index', $data);
  }

  public function gebruikteVoertuigen($Id)
  {
    $bowling = $this->bowlingModel->getBowlingById($Id);

    $gebruikteVoertuigen = $this->bowlingModel->getGebruikteVoertuigen($Id);

    if (sizeOf($gebruikteVoertuigen) == 0) {
      $rows = "<tr><td colspan='6'>Er zijn op dit moment nog geen voertuigen toegewezen aan deze bowling</td></tr>";
      header('Refresh:3; url=' . URLROOT . '/bowling/index');
    } else {
      $rows = '';
      foreach ($gebruikteVoertuigen as $value) {
        $rows .= "<tr>
                    <td>$value->TypeVoertuig</td>
                    <td>$value->Type</td>
                    <td>$value->Kenteken</td>
                    <td>$value->Bouwjaar</td>
                    <td>$value->Brandstof</td>
                    <td>$value->Rijbewijscategorie</td>
                  </tr>";
      }
    }


    $data = [
      'title' => 'Door Bowling gebruikte voertuigen',
      'voornaam' => $bowling->Voornaam,
      'tussenvoegsel' => $bowling->Tussenvoegsel,
      'achternaam' => $bowling->Achternaam,
      'datumInDienst' => $bowling->DatumInDienst,
      'aantalSterren' => $bowling->AantalSterren,
      'rows' => $rows
    ];

    $this->view('/bowling/gebruikteVoertuigen', $data);
  }


  public function Register()
  {
    $data = [];

    $this->view('/Bowling/Register', $data);
  }
  public function CreateAccount()
  {
    $this->bowlingModel->CreateAccount($_POST);
    header('Location: ' . URLROOT);
  }
  public function Persoonsgegevens()
  {
    $this->view('/Bowling/Persoonsgegevens');
  }
  public function contactEdit()
  {
    $this->view('/Bowling/contactEdit');
  }
  public function edit()
  {
    $this->view('/Bowling/edit');
  }
  public function ContactUpdate()
  {
    $this->bowlingModel->ContactUpdate($_POST);
    header('Location: ' . URLROOT);
  }
}
